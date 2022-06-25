<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class UserAndroid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $dispositivo = new Agent();
        if (Auth::check()){
            $role = Auth::user()->role;
        }else{
            $role = null;
        }
        if ($dispositivo->isMobile() || $role == 100){
            return $next($request);
        }else{
            return redirect()->route('cerrar');
        }

    }
}
