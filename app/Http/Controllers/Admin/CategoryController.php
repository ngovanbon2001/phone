<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface
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
        $categoryList = $this->categoryServiceInterface->list($request->all());

        return view('admin/category/show', compact('categoryList', 'categories', 'brands'));
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

        return view('admin/category/add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // create category
        $category = $this->categoryServiceInterface->create($request->all());

        session()->flash('messageAdd', $category->name . ' has been added.');
        return redirect()->route('showCate');
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

        // Get Category
        $category = $this->categoryServiceInterface->detail($id);

        return view('admin/category/update', compact('category', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        // Category
        $category = $this->categoryServiceInterface->update($request->all(), $id);

        session()->flash('messageUpdate', $category->name . ' has been updated.');
        return redirect()->route('showCate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->categoryServiceInterface->delete($id);

        if ($brand > Common::STATUS_INACTIVE) {
            session()->flash('messageDelete', 'Item has been deleted.');
        } else {
            session()->flash('messageError', 'Item cannot be deleted.');
        }

        return redirect()->route('showCate');
    }

    public function active(Request $request)
    {
        echo ($request->input("status"));

        return $this->categoryServiceInterface->updateActive($request->all());
    }
}
