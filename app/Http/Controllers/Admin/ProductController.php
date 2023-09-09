<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\FilterProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected BrandServiceInterface $brandServiceInterface;
    protected CategoryServiceInterface $categoryServiceInterface;
    protected ProductServiceInterface $productServiceInterface;
    private string $action = 'product';

    /**
     * @param BrandServiceInterface $brandServiceInterface
     * @param CategoryServiceInterface $categoryServiceInterface
     * @param ProductServiceInterface $productServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        ProductServiceInterface  $productServiceInterface
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
    }

    /**
     * Display a listing of the resource.
     * @param FilterProductRequest $request
     * @return Factory|View|Application
     */
    public function index(FilterProductRequest $request): Factory|View|Application
    {
        //all brand
        $products = $this->productServiceInterface->list($request->all());

        return view('admin/product/show', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        //all category
        $getCategories = $this->categoryServiceInterface->getAll();

        //all brand
        $getBrands = $this->brandServiceInterface->getAll();

        return view('admin/product/add', compact('getCategories', 'getBrands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        $product = $this->productServiceInterface->create($request->all());

        return $this->handleViewResponse(
            $product,
            'indexProduct',
            Common::ACTION[Common::ACTION_CREATE]. ' '.$this->action
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        //all category
        $getCategories = $this->categoryServiceInterface->getAll();

        //all brand
        $getBrands = $this->brandServiceInterface->getAll();

        // Products
        $product  = $this->productServiceInterface->detail($id);

        // Selected category
        $category = $this->categoryServiceInterface->detail($product->category_id);

        // Selected brand
        $brand    = $this->brandServiceInterface->detail($product->brand_id);

        return view('admin/product/update', compact('product', 'category', 'brand', 'getCategories', 'getBrands'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProductRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, int $id): RedirectResponse
    {
        $product = $this->productServiceInterface->update($request->all(), $id);

        return $this->handleViewResponse(
            $product,
            'indexProduct',
            Common::ACTION[Common::ACTION_UPDATE]. ' '.$this->action
        );
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = $this->productServiceInterface->delete($id);

        return $this->handleViewResponse(
            $product,
            'indexProduct',
            Common::ACTION[Common::ACTION_DELETE]. ' '.$this->action
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function active(Request $request): mixed
    {
        return $this->productServiceInterface->updateActive($request->all());
    }
}
