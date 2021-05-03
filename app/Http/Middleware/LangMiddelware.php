<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\App;


class LangMiddelware
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
        if( $request->cookie('language') )
        {
            App::setlocale($request->cookie('language'));
        }
        return $next($request);

    }
}