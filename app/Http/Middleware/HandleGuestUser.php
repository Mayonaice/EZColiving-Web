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
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
                'ip_address' => $ipAddress
            ];

            // Gunakan kombinasi device + platform + IP untuk device name yang lebih konsisten
            $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform'] . $deviceInfo['ip_address']);
            
            // Selalu coba buat atau update guest user
            try {
                $guestUser = GuestUser::firstOrCreate(
                    ['device_name' => $deviceName],
                    [
                        'device_info' => $deviceInfo,
                        'last_activity' => now(),
                        'cart_data' => [],
                        'booking_history' => []
                    ]
                );

                // Set session
                session(['guest_user' => $guestUser->id]);
                Log::info('Guest user operation successful', [
                    'id' => $guestUser->id,
                    'device_name' => $deviceName,
                    'route' => $currentRoute
                ]);

            } catch (\Exception $e) {
                Log::error('Error handling guest user', [
                    'error' => $e->getMessage(),
                    'device_name' => $deviceName
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