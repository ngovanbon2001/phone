<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderServiceInterface $orderServiceInterface;

    /**
     * @param OrderServiceInterface $orderServiceInterface
     */
    public function __construct(
        OrderServiceInterface    $orderServiceInterface,
    ) {
        $this->orderServiceInterface    = $orderServiceInterface;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $result = $this->orderServiceInterface->create($request->all());

        if ($result) {
            return redirect()->route('web.home');
        }

        return redirect()->route('cart');
    }
}
