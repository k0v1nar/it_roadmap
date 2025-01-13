<?php

namespace App\Http\Middleware;

use Closure;
use App\Components\admin\Auth;
use App\Models\User;

class CheckClient {
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!User::isUser()) {
            return redirect('/login/');
        }

        return $next($request);
    }
}