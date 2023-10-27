<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Color\CreateRequest;
use App\Services\Contracts\ColorServiceInterface;
use Illuminate\Http\RedirectResponse;

class ProductColorController extends Controller
{
    private string $action;
    protected ColorServiceInterface    $colorServiceInterface;

    /**
     * @param ColorServiceInterface    $productServiceInterface
     */
    public function __construct(
        ColorServiceInterface $colorServiceInterface,
    ) {
        $this->action = strtolower(__('languages.color'));
        $this->colorServiceInterface = $colorServiceInterface;
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateImageRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $color = $this->colorServiceInterface->create($request->all());

        return $this->handleViewResponseToBack(
            $color, 
            __('languages.'.Common::ACTION_CREATE). ' '.$this->action
        );
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param int $idp
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $color = $this->colorServiceInterface->delete($id);

        return $this->handleViewResponseToBack(
            $color,
            __('languages.'.Common::ACTION_DELETE). ' '.$this->action,
        );
    }
}
