<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $brandServiceInterface;
    protected $categoryServiceInterface;
    protected $bannerServiceInterface;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BrandServiceInterface    $brandServiceInterface,
        CategoryServiceInterface $categoryServiceInterface,
        BannerServiceInterface   $bannerServiceInterface,
    ) {
        $this->brandServiceInterface    = $brandServiceInterface;
        $this->categoryServiceInterface = $categoryServiceInterface;
        $this->bannerServiceInterface   = $bannerServiceInterface;
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

        //all banners
        $banners = $this->bannerServiceInterface->list($request->all());

        return view('admin/banners/show', compact('banners', 'categories', 'brands'));
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

        return view('admin/banners/add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {
        //create brand
        $banner = $this->bannerServiceInterface->create($request->all());

        session()->flash('messageAdd', $banner->title . ' has been added');
        return redirect()->route('indexBanners');
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

        //find banner
        $banner = $this->bannerServiceInterface->detail($id);

        return view('admin/banners/update', compact('banner', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        //find banner
        $banner = $this->bannerServiceInterface->update($request->all(), $id);

        session()->flash('messageUpdate', $banner->title . ' has been update');
        return redirect()->route('indexBanners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find banner
        $this->bannerServiceInterface->delete($id);

        session()->flash('messageDelete', 'Item has been deleted');
        return redirect()->route('indexBanners');
    }

    public function active(Request $request)
    {
        // echo ($request->input("status"));

        return $this->bannerServiceInterface->updateActive($request->all());
    }
}
