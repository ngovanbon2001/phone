<?php

namespace App\Http\Controllers;

use App\Constants\Common;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected ProductServiceInterface  $productServiceInterface;
    protected BrandServiceInterface    $brandServiceInterface;
    protected BannerServiceInterface   $bannerServiceInterface;
    protected CategoryServiceInterface $categoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface,
        BrandServiceInterface    $brandServiceInterface,
        BannerServiceInterface   $bannerServiceInterface,
        CategoryServiceInterface $categoryService
    )
    {
        $this->productServiceInterface = $productServiceInterface;
        $this->brandServiceInterface   = $brandServiceInterface;
        $this->bannerServiceInterface  = $bannerServiceInterface;
        $this->categoryService         = $categoryService;
    }

    /**
     * Show the application dashboard.
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $newProduct = $this->productServiceInterface->getProductFE([
            'is_new' => Common::ACTIVE,
            'active' => Common::ACTIVE
        ]);
        $discountProduct = $this->productServiceInterface->getProductFE([
            'price'  => Common::PRICE,
            'active' => Common::ACTIVE
        ]);
        $brands = $this->brandServiceInterface->list([]);
        $banners = $this->bannerServiceInterface->list([
            ["active", "=", Common::ACTIVE]
        ]);
        $categories = $this->categoryService->list([]);
        return view('web.home', compact('newProduct', 'discountProduct', 'brands', 'banners', 'categories'));
    }
}
