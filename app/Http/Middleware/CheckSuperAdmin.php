<?php

namespace App\Http\Middleware;

use Closure;
use App\Components\admin\Auth;

class CheckSuperAdmin {
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::isSuperAdmin()) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}