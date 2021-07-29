<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role {

    public function handle($request, Closure $next) {
        if (!Auth::check()) return redirect('/admin/login');

        $user = Auth::user();
        if($user->user_type_id == 1)
            return $next($request);

        return redirect('/');
    }
}
