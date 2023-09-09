<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Services\Contracts\BrandServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected BrandServiceInterface $brandServiceInterface;
    private string $action = 'brand';

    /**
     * @param BrandServiceInterface $brandServiceInterface
     */
    public function __construct(
        BrandServiceInterface $brandServiceInterface,
    ) {
        $this->brandServiceInterface = $brandServiceInterface;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        //all brand
        $brandList = $this->brandServiceInterface->list($request->all());

        return view('admin/brands/show', compact('brandList'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('admin/brands/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateBrandRequest $request
     * @return RedirectResponse
     */
    public function store(CreateBrandRequest $request): RedirectResponse
    {
        // Create Brand
        $brand = $this->brandServiceInterface->create($request->all());

        return $this->handleViewResponse(
            $brand,
            'showBrand',
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
        //find brand
        $brand = $this->brandServiceInterface->detail($id);

        return view('admin/brands/update', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBrandRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateBrandRequest $request, int $id): RedirectResponse
    {
        // Brand
        $brand = $this->brandServiceInterface->update($request->all(), $id);

        return $this->handleViewResponse(
            $brand,
            'showBrand',
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
        $brand = $this->brandServiceInterface->delete($id);

        return $this->handleViewResponse(
            $brand,
            'showBrand',
            Common::ACTION[Common::ACTION_DELETE]. ' '.$this->action
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function active(Request $request): mixed
    {
        return $this->brandServiceInterface->updateActive($request->all());
    }
}
