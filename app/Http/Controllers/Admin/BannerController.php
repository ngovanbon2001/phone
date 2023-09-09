<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Services\Contracts\BannerServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected BannerServiceInterface $bannerServiceInterface;
    private string $action = 'banner';

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(
        BannerServiceInterface   $bannerServiceInterface,
    ) {
        $this->bannerServiceInterface   = $bannerServiceInterface;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        //all banners
        $banners = $this->bannerServiceInterface->list($request->all());

        return view('admin/banners/show', compact('banners'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin/banners/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBannerRequest $request
     * @return RedirectResponse
     */
    public function store(CreateBannerRequest $request): RedirectResponse
    {
        //create brand
        $banner = $this->bannerServiceInterface->create($request->all());

        return $this->handleViewResponse(
            $banner,
            'indexBanners',
            Common::ACTION[Common::ACTION_CREATE]. ' '.$this->action
        );
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        //find banner
        $banner = $this->bannerServiceInterface->detail($id);

        return view('admin/banners/update', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBannerRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateBannerRequest $request, int $id): RedirectResponse
    {
        //find banner
        $banner = $this->bannerServiceInterface->update($request->all(), $id);

        return $this->handleViewResponse(
            $banner,
            'indexBanners',
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
        // find banner
        $banner = $this->bannerServiceInterface->delete($id);

        return $this->handleViewResponse(
            $banner,
            'indexBanners',
            Common::ACTION[Common::ACTION_DELETE]. ' ' .$this->action
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function active(Request $request): mixed
    {
        return $this->bannerServiceInterface->updateActive($request->all());
    }
}
