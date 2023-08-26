<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\CreateImageRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ImageServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class Product_imageController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;
    protected $productServiceInterface;
    protected $imageServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        ProductServiceInterface  $productServiceInterface,
        ImageServiceInterface  $imageServiceInterface,
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
        $this->imageServiceInterface    = $imageServiceInterface;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cate = $this->categoryServiceInterface->getAll();
        $band = $this->brandServiceInterface->getAll();
        $products = $this->productServiceInterface->detail($id);
        $image = $this->imageServiceInterface->list([['product_id', "=", $id]]);
        
        return view('admin/img_product/add', compact('products', 'image', 'cate', 'band'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateImageRequest $request)
    {
        $this->imageServiceInterface->create($request->all());
       
        session()->flash('messageAdd', 'Item has been added.');
        return redirect()->route('showImage', $request->product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = $this->categoryServiceInterface->getAll();
        $brands = $this->brandServiceInterface->getAll();

        $product = $this->productServiceInterface->detail($id);
        $images = $this->imageServiceInterface->list([['product_id', "=", $id]]);
        
        return view('admin/img_product/show', compact('images', 'product', 'categories', 'brands'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idp)
    {
        $this->imageServiceInterface->delete($id);

        session()->flash('messageAdd', 'Item has been deleted.');
        return redirect()->route('showImage', $idp);
    }
}
