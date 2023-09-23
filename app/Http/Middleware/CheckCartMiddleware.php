<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCartMiddleware
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
        $cartId = (int) $request->id ?? 0;
        $userId = auth()->user()->id ?? 0;

        if ($cartId !== $userId) {
            return response()->view('error');
        }

        return $next($request);
    }
}
