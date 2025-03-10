<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->expectsJson()) {
            if(str_starts_with(request()->route()->getPrefix(), 'admin')){
                if(!Auth::guard('admin')->check()){
                    session()->flash('fail', 'you must login first');
                    return redirect()->route('login'); 
                }
                    
            }

            if(str_starts_with(request()->route()->getPrefix(), 'technician')){                
                if(!Auth::guard('technician')->check()){
                    session()->flash('fail', 'you must login first');
                    return redirect()->route('tLogin'); 
                }
            }
        }
        return $next($request);   
    }
}