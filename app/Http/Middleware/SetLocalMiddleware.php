<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale') && array_key_exists(session()->get('locale'), config('languages'))) {
            App::setLocale(session()->get('locale'));
        } else {
            session()->put('locale', config('app.locale', 'vn'));
            App::setLocale(config('app.locale', 'vn'));
        }
        return $next($request);
    }
}
