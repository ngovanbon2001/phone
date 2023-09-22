<?php

namespace App\Http\Middleware;

use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Closure;
use Illuminate\Http\Request;

class ProductMiddleware
{
    protected ProductServiceInterface  $productServiceInterface;
    protected BrandServiceInterface    $brandServiceInterface;
    protected CategoryServiceInterface $categoryService;

    /**
     * @param ProductServiceInterface $productServiceInterface
     * @param CategoryServiceInterface $categoryService
     * @param BrandServiceInterface $brandServiceInterface
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface,
        CategoryServiceInterface $categoryService,
        BrandServiceInterface    $brandServiceInterface,
    ) {
        $this->productServiceInterface = $productServiceInterface;
        $this->brandServiceInterface   = $brandServiceInterface;
        $this->categoryService         = $categoryService;
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
        $brands     = $this->brandServiceInterface->list([]);
        $categories = $this->categoryService->list([]);
        $tags       = $this->productServiceInterface->getTags();
        view()->share(['brands' => $brands, 'categories' => $categories, 'tags' => $tags]);
        return $next($request);
    }
}
