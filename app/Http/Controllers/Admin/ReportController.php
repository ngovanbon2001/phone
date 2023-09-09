<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\ReportServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    protected OrderServiceInterface $orderServiceInterface;
    protected ReportServiceInterface $reportServiceInterface;
    protected ProductServiceInterface $productServiceInterface;

    /**
     * @param OrderServiceInterface $orderServiceInterface
     * @param ReportServiceInterface $reportServiceInterface
     * @param ProductServiceInterface $productServiceInterface
     */
    public function __construct(
        OrderServiceInterface    $orderServiceInterface,
        ReportServiceInterface   $reportServiceInterface,
        ProductServiceInterface  $productServiceInterface
    ) {
        $this->orderServiceInterface    = $orderServiceInterface;
        $this->reportServiceInterface   = $reportServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $order     = json_encode($this->orderServiceInterface->listItem()->toArray()["data"]);
        $orderData = json_encode($this->orderServiceInterface->getOrder()->toArray()["data"]);
        $product   = json_encode($this->productServiceInterface->getProduct()->toArray()["data"]);

        return view('admin/report/report', compact('order', 'orderData', 'product'));
    }
}
