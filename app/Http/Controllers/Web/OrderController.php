<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderServiceInterface $orderServiceInterface;
    protected UserServiceInterface  $userService;

    /**
     * @param OrderServiceInterface $orderServiceInterface
     * @param UserServiceInterface  $userService
     */
    public function __construct(
        OrderServiceInterface $orderServiceInterface,
        UserServiceInterface  $userService,
    ) {
        $this->orderServiceInterface = $orderServiceInterface;
        $this->userService           = $userService;
    }

    /**
     * @param Request $request
     * @return View|Factory|Application|RedirectResponse
     */
    public function store(Request $request): View|Factory|Application|RedirectResponse
    {
        $order = $this->orderServiceInterface->create($request->all());

        if ($order) {
            return view('web/order_success', compact('order'));
        }

        return redirect()->route('cart');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        $order = $this->userService->show($id);
        return view('web/order', compact('order'));
    }
}
