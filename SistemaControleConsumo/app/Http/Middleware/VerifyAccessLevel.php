<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        $match = preg_match('/' . Auth()->user()->access_level . '/', $level);
        
        if($match == 0)
        {
            \Session::flash('flash_message_error', 'Você não possui permissão para acessar essa funcionalidade!');
            return redirect('/admin');
        }
        return $next($request);
    }
}
