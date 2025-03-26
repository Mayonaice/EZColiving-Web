<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GuestUser;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;

class CheckGuestIp
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $agent = new Agent();
            $deviceInfo = [
                'device' => $agent->device() ?? 'unknown',
                'platform' => $agent->platform() ?? 'unknown',
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
                'ip_address' => $request->ip()
            ];
            
            // Gunakan hanya device dan platform untuk device name
            $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform']);
            
            Log::info('Checking guest user access', [
                'device_name' => $deviceName,
                'device_info' => $deviceInfo,
                'route' => $request->route()->getName()
            ]);
            
            $guestUser = GuestUser::where('device_name', $deviceName)->first();
            
            if (!$guestUser) {
                Log::warning('Guest user not found', [
                    'device_name' => $deviceName,
                    'device_info' => $deviceInfo
                ]);
                return redirect()->route('userhome')->with('error', 'Maaf, Anda tidak memiliki akses untuk melihat kamar.');
            }
            
            Log::info('Guest user found', [
                'guest_user_id' => $guestUser->id,
                'device_name' => $deviceName
            ]);
            
            return $next($request);
        } catch (\Exception $e) {
            Log::error('Error in CheckGuestIp middleware', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('userhome')->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }
} 