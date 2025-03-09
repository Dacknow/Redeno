<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirecTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if($request->routeIs('admin.*')){
                session()->flash('fail', 'you must login first');
               return redirect()->route('login'); 
            }

            if($request->routeIs('technician.*')){
                session()->flash('fail', 'you must login first');
               return redirect()->route('t.login'); 
            }
            
        }
        return null;
    }
}
