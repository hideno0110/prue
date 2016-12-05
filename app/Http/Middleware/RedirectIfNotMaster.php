<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotMaster
{
    /**
     * 送られてきたリクエストの処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'master')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('master/login');
        }

        return $next($request);
    }
}
