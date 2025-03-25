<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GuestUser;

class CheckGuestIp
{
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();
        
        $guestUser = GuestUser::where('ip_address', $ipAddress)->first();
        
        if (!$guestUser) {
            return redirect()->route('userhome')->with('error', 'Maaf, Anda tidak memiliki akses untuk melihat kamar.');
        }
        
        return $next($request);
    }
} 