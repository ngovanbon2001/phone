<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserServiceInterface $userServiceInterface;
    private string $action = 'staff';

    /**
     * @param UserServiceInterface $userServiceInterface
     */
    public function __construct(
        UserServiceInterface $userServiceInterface
    ) {
        $this->userServiceInterface = $userServiceInterface;
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $users = $this->userServiceInterface->list($request->all());

        return view('admin/user/show', compact('users'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('admin/user/add');
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $staff = $this->userServiceInterface->create($request->all());

        return $this->handleViewResponse(
            $staff,
            'indexUser',
            Common::ACTION[Common::ACTION_CREATE]. ' '.$this->action
        );
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        // Get Staff
        $staff = $this->userServiceInterface->detail($id);

        return view('admin/user/update', compact('staff'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $staff = $this->userServiceInterface->update($request->all(), $id);

        return $this->handleViewResponse(
            $staff,
            'indexUser',
            Common::ACTION[Common::ACTION_UPDATE]. ' '.$this->action
        );
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function show(int $id): Factory|View|Application
    {
        // Get Staff
        $staff = $this->userServiceInterface->detail($id);

        return view('admin/profile/show', compact('staff'));
    }

    /**
     * @param UpdateProfileRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request, int $id): RedirectResponse
    {
        $staff = $this->userServiceInterface->update($request->all(), $id);

        return $this->handleViewResponse(
            $staff,
            'showUser',
            Common::ACTION[Common::ACTION_UPDATE]. ' '.$this->action,
            '',
            $id
        );
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $staff = $this->userServiceInterface->delete($id);

        return $this->handleViewResponse(
            $staff,
            'indexUser',
            Common::ACTION[Common::ACTION_DELETE]. ' '.$this->action
        );
    }
}
