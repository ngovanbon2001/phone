<?php

namespace App\Http\Controllers\Web;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    protected UserServiceInterface $userServiceInterface;
    private string $action;

    /**
     * @param UserServiceInterface $userServiceInterface
     */
    public function __construct(
        UserServiceInterface $userServiceInterface
    ) {
        $this->action = strtolower(__('languages.account'));
        $this->userServiceInterface = $userServiceInterface;
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        // Get user
        $user = $this->userServiceInterface->detailCustomer($id);

        return view('auth/update', compact('user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, int $id): RedirectResponse
    {
        $user = $this->userServiceInterface->updateCustomer($request->all(), $id);

        return $this->handleViewResponseToBack(
            $user,
            __('languages.' . Common::ACTION_UPDATE) . ' ' . $this->action
        );
    }
}
