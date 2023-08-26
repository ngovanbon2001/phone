<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Constants\Common;
use App\Models\Order_item;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\ReportServiceInterface;

class ReportController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;
    protected $orderServiceInterface;
    protected $reportServiceInterface;
    protected $productServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        OrderServiceInterface    $orderServiceInterface,
        ReportServiceInterface   $reportServiceInterface,
        ProductServiceInterface  $productServiceInterface
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->orderServiceInterface    = $orderServiceInterface;
        $this->reportServiceInterface   = $reportServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryServiceInterface->getAll();
        $brands = $this->brandServiceInterface->getAll();
        $order = json_encode($this->orderServiceInterface->listItem()->toArray()["data"]);
        $orderData = json_encode($this->orderServiceInterface->getOrder()->toArray()["data"]);
        $product = json_encode($this->productServiceInterface->getProduct()->toArray()["data"]);

        return view('admin/report/report', compact('categories', 'brands', 'order', 'orderData', 'product'));
    }
}
