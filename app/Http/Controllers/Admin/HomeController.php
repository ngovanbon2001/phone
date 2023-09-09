<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\ReportServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected OrderServiceInterface   $orderServiceInterface;
    protected ReportServiceInterface  $reportServiceInterface;
    protected ProductServiceInterface $productServiceInterface;
    protected UserServiceInterface    $userServiceInterface;

    /**
     * @param OrderServiceInterface   $orderServiceInterface
     * @param ReportServiceInterface  $reportServiceInterface
     * @param ProductServiceInterface $productServiceInterface
     * @param UserServiceInterface    $userServiceInterface
     */
    public function __construct(
        OrderServiceInterface    $orderServiceInterface,
        ReportServiceInterface   $reportServiceInterface,
        ProductServiceInterface  $productServiceInterface,
        UserServiceInterface     $userServiceInterface
    ) {
        $this->orderServiceInterface    = $orderServiceInterface;
        $this->reportServiceInterface   = $reportServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
        $this->userServiceInterface     = $userServiceInterface;
    }

    /**
     * @return Application|Factory|View
     */
    public function home(): View|Factory|Application
    {
        $order     = json_encode($this->orderServiceInterface->listItem()->toArray()["data"]);
        $orderData = json_encode($this->orderServiceInterface->getOrder()->toArray()["data"]);
        $product   = json_encode($this->productServiceInterface->getProduct()->toArray()["data"]);
        $total     = $this->orderServiceInterface->count();
        $totalUser = $this->userServiceInterface->countUser();

        return view('admin/home', compact('order', 'orderData', 'total', 'product', 'totalUser'));
    }

    /**
     * @return Application|Factory|View
     */
    public function contact(): View|Factory|Application
    {
        return view('admin.profile.contact');
    }
}
