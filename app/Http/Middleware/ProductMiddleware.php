<?php

namespace App\Http\Middleware;

use App\Constants\Common;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Closure;
use Illuminate\Http\Request;

class ProductMiddleware
{
    protected ProductServiceInterface  $productServiceInterface;

    /**
     * @param ProductServiceInterface $productServiceInterface
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface,
    ) {
        $this->productServiceInterface = $productServiceInterface;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $brands     = app(BrandRepositoryInterface::class)
                        ->whereNull('deleted_at')
                        ->where('active', Common::ACTIVE)
                        ->get();
        $categories = app(CategoryReponsitoryInterface::class)
                        ->whereNull('deleted_at')
                        ->where('active', Common::ACTIVE)
                        ->get();
        $tags       = $this->productServiceInterface->getTags();
        view()->share(['brands' => $brands, 'categories' => $categories, 'tags' => $tags]);
        return $next($request);
    }
}
