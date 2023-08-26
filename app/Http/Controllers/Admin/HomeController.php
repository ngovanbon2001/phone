<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\ReportServiceInterface;
use App\Services\Contracts\UserServiceInterface;

class HomeController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;
    protected $orderServiceInterface;
    protected $reportServiceInterface;
    protected $productServiceInterface;
    protected $userServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        OrderServiceInterface    $orderServiceInterface,
        ReportServiceInterface   $reportServiceInterface,
        ProductServiceInterface  $productServiceInterface,
        UserServiceInterface     $userServiceInterface
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->orderServiceInterface    = $orderServiceInterface;
        $this->reportServiceInterface   = $reportServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
        $this->userServiceInterface     = $userServiceInterface;
    }
    
    public function home()
    {
        $categories = $this->categoryServiceInterface->getAll();
        $brands = $this->brandServiceInterface->getAll();
        $order = json_encode($this->orderServiceInterface->listItem()->toArray()["data"]);
        $orderData = json_encode($this->orderServiceInterface->getOrder()->toArray()["data"]);
        $product = json_encode($this->productServiceInterface->getProduct()->toArray()["data"]);
        $total = $this->orderServiceInterface->count();
        $totalUser = $this->userServiceInterface->countUser();

        return view('admin/home', compact('categories', 'brands', 'order', 'orderData', 'total', 'product', 'totalUser'));
    }

    public function contact()
    {
        $categories = $this->categoryServiceInterface->getAll();
        $brands = $this->brandServiceInterface->getAll();

        return view('admin.profile.contact', compact('categories', 'brands'));
    }
}
