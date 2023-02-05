<?php

namespace App\Http\Middleware;

use Closure;

class IsIdNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ($request->route('id') != NULL)
        // {
        //     if (is_numeric($request->route('id')))
        //     {
        //         return $next($request);
        //      }
        
        //     return redirect()->back()->with('error', 'error occured');
        // }

        return $next($request);
    }
}
