<?php

namespace App\Http\Controllers\Web;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Services\Contracts\CartServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartServiceInterface $cartServiceInterface;
    protected OrderServiceInterface $orderServiceInterface;
    private string $action = 'cart';

    /**
     * @param CartServiceInterface  $cartServiceInterface
     * @param OrderServiceInterface $orderServiceInterface
     */
    public function __construct(
        CartServiceInterface  $cartServiceInterface,
        OrderServiceInterface $orderServiceInterface
    ) {
        $this->cartServiceInterface  = $cartServiceInterface;
        $this->orderServiceInterface = $orderServiceInterface;
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function index(int $id): Factory|View|Application
    {
        $carts = $this->cartServiceInterface->list($id);
        return view('web.cart', compact('carts'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $cart = $this->cartServiceInterface->create($request->all());

        if ($cart){
            session()->flash('message', Common::ACTION[Common::ACTION_CREATE]. ' '.$this->action.' successful! ');
        } else {
            session()->flash('message-error', 'Fail '. Common::ACTION[Common::ACTION_CREATE]. ' '.$this->action);
        }

        return redirect()->route('cart', auth()->user()->id ?? 0);
    }

    public function update(Request $request): JsonResponse
    {
        $carts  = $request->all();
        $result = $this->cartServiceInterface->update($request->all(), $carts['cart_id']);
        return $this->response($result);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function delivery(Request $request): mixed
    {
        return $this->orderServiceInterface->select_delivery($request->all());
    }
}
