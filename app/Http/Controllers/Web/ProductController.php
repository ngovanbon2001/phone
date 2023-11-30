<?php

namespace App\Http\Controllers\Web;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\ReportServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceInterface  $productServiceInterface;
    protected ReportServiceInterface $reportService;

    /**
     * @param ProductServiceInterface $productServiceInterface
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface,
        ReportServiceInterface  $reportService,
    ) {
        $this->productServiceInterface = $productServiceInterface;
        $this->reportService  = $reportService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $products = $this->productServiceInterface->getProductFE($request->all());

        return view('web.product', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|View|Application
     */
    public function show(int $id): Factory|View|Application
    {
        // Products
        $product = $this->productServiceInterface->detail($id);

        $products = $this->productServiceInterface->getProductFE([]);

        $newProduct = $this->productServiceInterface->getProductFE([
            'is_new' => Common::ACTIVE,
            'active' => Common::ACTIVE
        ]);

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        $comment = $this->reportService->list([
            ['product_id', '=', $id]
        ]);

        return view('web.detail_product', compact('product', 'products', 'newProduct', 'comment'));
    }
}
