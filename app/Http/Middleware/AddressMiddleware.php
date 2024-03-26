<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressMiddleware
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
        $provinces = DB::table('provinces')->get();

        //all category
        $categories = DB::table('categories')->whereNull('deleted_at')->get();

        //all brand
        $brands = DB::table('brands')->whereNull('deleted_at')->get();

        view()->share(['provinces' => $provinces ?? [], 'categories' => $categories ?? [], 'brands' => $brands ?? []]);
        
        return $next($request);
    }
}
