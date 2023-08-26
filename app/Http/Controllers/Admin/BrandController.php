<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $categoryServiceInterface;
    protected $brandServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        CategoryServiceInterface $categoryServiceInterface,
        BrandServiceInterface    $brandServiceInterface,
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //all category
        $categories = $this->categoryServiceInterface->getAll();

        //all brand
        $brands = $this->brandServiceInterface->getAll();

        //all brand
        $brandList = $this->brandServiceInterface->list($request->all());

        return view('admin/brands/show', compact('brandList', 'categories', 'brands'));
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

        return view('admin/brands/add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        // Create Brand
        $brand = $this->brandServiceInterface->create($request->all());

        session()->flash('messageAdd', $brand->name . ' has been added.');
        return redirect()->route('showBrand');
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

        //find brand
        $brand = $this->brandServiceInterface->detail($id);

        return view('admin/brands/update', compact('brand', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        // Brand
        $brand = $this->brandServiceInterface->update($request->all(), $id);

        session()->flash('messageDelete', $brand->name . ' has been updated.');
        return redirect()->route('showBrand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brandServiceInterface->delete($id);

        if ($brand > Common::STATUS_INACTIVE) {
            session()->flash('messageDelete', 'Item has been deleted.');
        } else {
            session()->flash('messageError', 'Item cannot be deleted.');
        }
        return redirect()->route('showBrand');
    }

    public function active(Request $request)
    {
        echo ($request->input("status"));

        return $this->brandServiceInterface->updateActive($request->all());
    }
}
