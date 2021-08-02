<?php

namespace App\Http\Middleware;
use App\Models\Log;
use Closure;


class LogApiMiddelware
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
        $log = new Log();
        $log->user_id = $request->auth_id?$request->auth_id:0;
        $log->url = $request->url();
        $log->ip_address = $request->ip_address?$request->ip_address:$request->ip();
        $log->method = $request->method();
        $log->lang = languageLocale();
        $log->save();
        return $next($request);
    }
}
