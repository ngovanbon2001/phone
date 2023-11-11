<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\StatisticServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    protected StatisticServiceInterface $statisticService;

    /**
     * @param StatisticServiceInterface $statisticService
     */
    public function __construct(
        StatisticServiceInterface $statisticService
    ) {
        $this->statisticService = $statisticService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $listItem  = $this->statisticService->listItem();
        $listOrder = $this->statisticService->getOrder();
        $listProduct = $this->statisticService->getProduct();
        $order     = json_encode($listItem->toArray()["data"] ?? []);
        $orderData = json_encode($listOrder->toArray()["data"] ?? []);
        $product   = json_encode($listProduct->toArray()["data"] ?? []);

        return view('admin/report/report',
            compact('order', 'orderData', 'product', 'listItem', 'listOrder', 'listProduct')
        );
    }
}
