<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected UserServiceInterface $userServiceInterface;
    private string $action = 'languages.customer';

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
        $users = $this->userServiceInterface->listCustomer($request->all());

        return view('admin/customer/show', compact('users'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $staff = $this->userServiceInterface->deleteCustomer($id);

        return $this->handleViewResponse(
            $staff,
            'customer.list',
            __('languages.'.Common::ACTION_DELETE). ' '.strtolower(__($this->action))
        );
    }
}
