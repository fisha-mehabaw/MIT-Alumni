<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $currentRole = Session::get('currentRole');
            
            if(Session::get('currentRole') == "Admin")
            {
                return  redirect()->route('admin.dashboard')->with('success', 'Already Signed in.');
            }
            if(Session::get('currentRole') == "Department Head")
            {
                return  redirect()->route('departmentHead.home')->with('success', 'Already Signed in.');
            }
            if(Session::get('currentRole') == "Registrar")
            {
                return  redirect()->route('registrar.home')->with('success', 'Already Signed in.');
            }
            if(Session::get('currentRole') == "Alumni")
            {
                return  redirect()->route('alumnies.home')->with('success', 'Already Signed in.');
            }
        }

        return $next($request);
    }
}
