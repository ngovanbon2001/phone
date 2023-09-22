<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceInterface $productServiceInterface;
    protected BrandServiceInterface    $brandServiceInterface;
    protected CategoryServiceInterface $categoryService;

    /**
     * @param ProductServiceInterface $productServiceInterface
     * @param CategoryServiceInterface $categoryService
     * @param BrandServiceInterface $brandServiceInterface
     */
    public function __construct(
        ProductServiceInterface  $productServiceInterface,
        CategoryServiceInterface $categoryService,
        BrandServiceInterface    $brandServiceInterface,
    ) {
        $this->productServiceInterface = $productServiceInterface;
        $this->brandServiceInterface   = $brandServiceInterface;
        $this->categoryService         = $categoryService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $products = $this->productServiceInterface->getProductFE($request->all());

        $brands = $this->brandServiceInterface->list([]);
        $categories = $this->categoryService->list([]);
        $tags = $this->productServiceInterface->getTags();

        return view('web.product', compact('products', 'brands', 'categories', 'tags'));
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
