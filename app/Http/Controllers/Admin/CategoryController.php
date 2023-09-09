<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryServiceInterface $categoryServiceInterface;
    private string $action = 'category';

    /**
     * @param CategoryServiceInterface $categoryServiceInterface
     */
    public function __construct(
        CategoryServiceInterface $categoryServiceInterface
    ) {
        $this->categoryServiceInterface = $categoryServiceInterface;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        //all brand
        $categoryList = $this->categoryServiceInterface->list($request->all());

        return view('admin/category/show', compact('categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('admin/category/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        // create category
        $category = $this->categoryServiceInterface->create($request->all());

        return $this->handleViewResponse(
            $category,
            'showCate',
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
        // Get Category
        $category = $this->categoryServiceInterface->detail($id);

        return view('admin/category/update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, int $id): RedirectResponse
    {
        // Category
        $category = $this->categoryServiceInterface->update($request->all(), $id);

        return $this->handleViewResponse(
            $category,
            'showCate',
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
        $category = $this->categoryServiceInterface->delete($id);

        return $this->handleViewResponse(
            $category,
            'showCate',
            Common::ACTION[Common::ACTION_DELETE]. ' '.$this->action
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function active(Request $request): mixed
    {
        return $this->categoryServiceInterface->updateActive($request->all());
    }
}
