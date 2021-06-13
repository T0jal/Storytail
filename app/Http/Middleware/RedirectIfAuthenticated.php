<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

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
            $user_type = Auth::user()->user_type_id;

            switch ($user_type) {
                case '1':
                    return redirect('/admin');
                    break;
                case '2':
                    return redirect('/user');
                    break;

                default:
                    return redirect('/home');
                    break;
            }
        }

        return $next($request);
    }
}
