<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Image\CreateImageRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ImageServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class Product_imageController extends Controller
{
    protected BrandServiceInterface    $brandServiceInterface;
    protected CategoryServiceInterface $categoryServiceInterface;
    protected ProductServiceInterface  $productServiceInterface;
    protected ImageServiceInterface    $imageServiceInterface;
    private string $action = 'image';

    /**
     * @param BrandServiceInterface    $brandServiceInterface
     * @param CategoryServiceInterface $categoryServiceInterface
     * @param ProductServiceInterface  $productServiceInterface
     * @param ImageServiceInterface    $imageServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        ProductServiceInterface  $productServiceInterface,
        ImageServiceInterface    $imageServiceInterface,
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->productServiceInterface  = $productServiceInterface;
        $this->imageServiceInterface    = $imageServiceInterface;
    }

    /**
     * Show the form for creating a new resource.
     * @param $id
     * @return Factory|View|Application
     */
    public function create($id): Factory|View|Application
    {
        $cate     = $this->categoryServiceInterface->getAll();
        $band     = $this->brandServiceInterface->getAll();
        $products = $this->productServiceInterface->detail($id);
        $image    = $this->imageServiceInterface->list([['product_id', "=", $id]]);

        return view('admin/img_product/add', compact('products', 'image', 'cate', 'band'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateImageRequest $request
     * @return RedirectResponse
     */
    public function store(CreateImageRequest $request): RedirectResponse
    {
        $images = $this->imageServiceInterface->create($request->all());

        return $this->handleViewResponse(
            $images,
            'showImage',
            Common::ACTION[Common::ACTION_CREATE]. ' '.$this->action,
            '',
            $request->input('product_id') ?? null
        );
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return Factory|View|Application
     */
    public function show(int $id): Factory|View|Application
    {
        $product = $this->productServiceInterface->detail($id);
        $images = $this->imageServiceInterface->list([['product_id', "=", $id]]);

        return view('admin/img_product/show', compact('images', 'product'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param int $idp
     * @return RedirectResponse
     */
    public function destroy(int $id, int $idp): RedirectResponse
    {
        $images = $this->imageServiceInterface->delete($id);

        return $this->handleViewResponse(
            $images,
            'showImage',
            Common::ACTION[Common::ACTION_DELETE]. ' '.$this->action,
            '',
            $idp
        );
    }
}
