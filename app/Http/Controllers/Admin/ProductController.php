<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\FilterProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;
    protected $productServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        ProductServiceInterface  $productServiceInterface
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->productServiceInterface = $productServiceInterface;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterProductRequest $request)
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        //all brand
        $products = $this->productServiceInterface->list($request->all());

        return view('admin/product/show', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        return view('admin/product/add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->productServiceInterface->create($request->all());

        session()->flash('messageAdd', $product->name . ' has been added.');
        return redirect()->route('indexProduct');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        // Products
        $product = $this->productServiceInterface->detail($id);

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        // Selected category
        $category = $this->categoryServiceInterface->detail($product->category_id);

        // Selected brand
        $brand = $this->brandServiceInterface->detail($product->brand_id);

        return view('admin/product/update', compact('categories', 'brands', 'product', 'category', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $products = $this->productServiceInterface->update($request->all(), $id);

        session()->flash('messageUpdate', $products->name . ' has been updated.');

        return redirect()->route('indexProduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find product
        $product = $this->productServiceInterface->detail($id);

        //Check exist
        if (!isset($product->id)) {
            return view('error');
        }

        $this->productServiceInterface->delete($id);

        session()->flash('messageDelete', $product->name . ' has been deleted.');
        return redirect()->route('indexProduct');
    }

    public function active(Request $request)
    {
        echo ($request->input("status"));

        return $this->productServiceInterface->updateActive($request->all());
    }
}
