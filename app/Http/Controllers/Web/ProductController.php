<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface
    ) {
        $this->productServiceInterface = $productServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productServiceInterface->getProductFE($request->all());

        return view('web.product', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
