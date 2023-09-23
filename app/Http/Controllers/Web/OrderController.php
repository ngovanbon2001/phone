<?php

namespace App\Http\Controllers\Web;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateRequest;
use App\Services\Contracts\CartServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    protected CartServiceInterface $cartServiceInterface;
    protected OrderServiceInterface $orderServiceInterface;
    protected UserServiceInterface  $userService;

    /**
     * @param CartServiceInterface  $cartServiceInterface
     * @param OrderServiceInterface $orderServiceInterface
     * @param UserServiceInterface  $userService
     */
    public function __construct(
        CartServiceInterface  $cartServiceInterface,
        OrderServiceInterface $orderServiceInterface,
        UserServiceInterface  $userService,
    ) {
        $this->cartServiceInterface  = $cartServiceInterface;
        $this->orderServiceInterface = $orderServiceInterface;
        $this->userService           = $userService;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return View|Factory|Application|RedirectResponse
     */
    public function create(Request $request, int $id): View|Factory|Application|RedirectResponse
    {
        $items = $this->cartServiceInterface->list($id) ?? [];
        return view('web/check_out', compact('items'));
    }

    /**
     * @param CreateRequest $request
     * @return View|Factory|Application|RedirectResponse
     */
    public function store(CreateRequest $request): View|Factory|Application|RedirectResponse
    {
        $order = $this->orderServiceInterface->create($request->all());

        if ($order) {
            return view('web/order_success', compact('order'));
        }

        return redirect()->route('cart', (auth()->user()->id ?? 0));
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

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function detail(int $id): Factory|View|Application
    {
        $order = $this->orderServiceInterface->detail($id);
        return view('web/detail_order', compact('order'));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function exportPdf(int $id): mixed
    {
        $order = $this->orderServiceInterface->detail($id);
        $pdf   = PDF::loadView('web/pdf', compact('order'));
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', true);
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVuSans');
        return $pdf->download('bill.pdf');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function cancel(int $id): RedirectResponse
    {
        $order = $this->orderServiceInterface->cancel($id);

        return $this->handleViewResponse(
            $order,
            'order.show',
            Common::ACTION[Common::ACTION_CANCEL]. ' order!',
            'Cancel order successful.',
            auth()->user()->id ?? 0
        );
    }
}
