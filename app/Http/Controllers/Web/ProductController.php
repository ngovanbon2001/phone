<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceInterface $productServiceInterface;

    /**
     * @param ProductServiceInterface $productServiceInterface
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface
    ) {
        $this->productServiceInterface = $productServiceInterface;
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

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        return view('web.detail_product', compact('product'));
    }
}
