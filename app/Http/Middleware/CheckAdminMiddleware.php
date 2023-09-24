<?php

namespace App\Http\Middleware;

use App\Constants\Common;
use Closure;
use Illuminate\Http\Request;

class CheckAdminMiddleware
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
        if (isset(auth()->guard(Common::GUARD_ADMIN)->user()->permission) && ((int) auth()->guard(Common::GUARD_ADMIN)->user()->permission !== Common::ADMIN)) {
            return response()->view('error');
        }

        return $next($request);
    }
}
