<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GuestUser;
use Jenssegers\Agent\Agent;

class CheckGuestIp
{
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $deviceInfo = [
            'device' => $agent->device() ?? 'unknown',
            'platform' => $agent->platform() ?? 'unknown',
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop(),
            'ip_address' => $request->ip()
        ];
        
        // Gunakan kombinasi device + platform + IP untuk device name yang lebih konsisten
        $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform'] . $deviceInfo['ip_address']);
        
        $guestUser = GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
            return redirect()->route('userhome')->with('error', 'Maaf, Anda tidak memiliki akses untuk melihat kamar.');
        }
        
        return $next($request);
    }
} 