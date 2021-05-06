<?php

namespace App\Http\Middleware;
use Closure;


class PermissionMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission)
    {
       return permissionShow($permission) ? $next($request) : redirect('error/403');
    }
}
