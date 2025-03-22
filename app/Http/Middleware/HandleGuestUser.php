<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class HandleGuestUser
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $currentRoute = Route::currentRouteName();
            
            // Skip untuk admin routes
            if ($request->is('admin/*')) {
                Log::info('Skipping admin route');
                return $next($request);
            }

            // Deteksi IP dengan berbagai metode
            $ipAddress = $this->getIpAddress($request);
            Log::info('IP Address detected', [
                'ip' => $ipAddress,
                'headers' => [
                    'X-Forwarded-For' => $request->header('X-Forwarded-For'),
                    'X-Real-IP' => $request->header('X-Real-IP'),
                    'Remote-Addr' => $request->server('REMOTE_ADDR'),
                    'Client-IP' => $request->header('Client-IP'),
                ]
            ]);

            // Cek koneksi database
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                Log::error('Database connection failed: ' . $e->getMessage());
                return $next($request);
            }

            $agent = new Agent();
            $deviceInfo = [
                'device' => $agent->device() ?? 'unknown',
                'platform' => $agent->platform() ?? 'unknown',
                'browser' => $agent->browser() ?? 'unknown',
                'version' => $agent->version($agent->browser()) ?? 'unknown',
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
            ];

            // Selalu coba buat atau update guest user
            try {
                $guestUser = GuestUser::updateOrCreate(
                    ['ip_address' => $ipAddress],
                    [
                        'device_info' => json_encode($deviceInfo),
                        'last_activity' => now(),
                        'cart_data' => json_encode([]),
                        'booking_history' => json_encode([])
                    ]
                );

                // Set session
                session(['guest_user' => $guestUser]);
                Log::info('Guest user operation successful', [
                    'id' => $guestUser->id,
                    'ip' => $guestUser->ip_address,
                    'route' => $currentRoute
                ]);

            } catch (\Exception $e) {
                Log::error('Error handling guest user', [
                    'error' => $e->getMessage(),
                    'ip' => $ipAddress
                ]);
            }

        } catch (\Exception $e) {
            Log::error('HandleGuestUser middleware error', [
                'error' => $e->getMessage()
            ]);
        }

        return $next($request);
    }

    private function getIpAddress(Request $request)
    {
        // Cek X-Forwarded-For header (biasanya dari proxy/load balancer)
        $forwardedFor = $request->header('X-Forwarded-For');
        if ($forwardedFor) {
            $ips = explode(',', $forwardedFor);
            return trim($ips[0]);
        }

        // Cek X-Real-IP header
        $realIp = $request->header('X-Real-IP');
        if ($realIp) {
            return $realIp;
        }

        // Cek Client-IP header
        $clientIp = $request->header('Client-IP');
        if ($clientIp) {
            return $clientIp;
        }

        // Fallback ke REMOTE_ADDR
        return $request->ip();
    }
} 