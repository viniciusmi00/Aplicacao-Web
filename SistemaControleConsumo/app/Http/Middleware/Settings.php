<?php

namespace App\Http\Middleware;

use Closure;
use anlutro\LaravelSettings\Facade as SettingsFacade;
use Illuminate\Support\Facades\Auth;

class Settings
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
        return $next($request);
    }
}
