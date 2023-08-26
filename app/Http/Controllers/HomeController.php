<?php

namespace App\Http\Controllers;

use App\Constants\Common;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productServiceInterface;
    protected $brandServiceInterface;
    protected $bannerServiceInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface,
        BrandServiceInterface    $brandServiceInterface,
        BannerServiceInterface   $bannerServiceInterface
    )
    {
        $this->productServiceInterface = $productServiceInterface;
        $this->brandServiceInterface   = $brandServiceInterface;
        $this->bannerServiceInterface   = $bannerServiceInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newProduct = $this->productServiceInterface->getProductFE([
            ["is_new", "=", Common::ACTIVE],
            ["active", "=", Common::ACTIVE]
        ]);
        $discountProduct = $this->productServiceInterface->getProductFE([
            ["price", "<", Common::PRICE],
            ["active", "=", Common::ACTIVE]
        ]);
        $brands = $this->brandServiceInterface->list([]);
        $banners = $this->bannerServiceInterface->list([
            ["active", "=", Common::ACTIVE]
        ]);
        return view('web.home', compact('newProduct', 'discountProduct', 'brands', 'banners'));
    }
}
