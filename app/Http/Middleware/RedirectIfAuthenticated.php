<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->expectsJson()) {
            if(str_starts_with(request()->route()->getPrefix(), 'admin')){
                if(Auth::guard('admin')->check()){;
                    return redirect()->route('dashboard'); 
                }                    
            }

            if(str_starts_with(request()->route()->getPrefix(), 'technician')){                
                if(Auth::guard('technician')->check()){
                    return redirect()->route('home'); 
                }
            }
        }
        return $next($request);
    }
}

