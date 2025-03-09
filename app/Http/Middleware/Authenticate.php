<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->expectsJson()) {
            if($request->routeIs('admin.*')){
                session()->flash('fail', 'you must login first');
               return redirect()->route('login'); 
            }

            if($request->routeIs('technician.*')){
                dd('entro');
                session()->flash('fail', 'you must login first');
               return redirect()->route('tLogin'); 
            }
            
        }
        return $next($request);
    }
}
