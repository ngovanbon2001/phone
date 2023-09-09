<?php

namespace App\Services;

use App\Constants\StatusCodeMessage;
use App\Exceptions\CartException;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\CartServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService implements CartServiceInterface
{
    protected ProductReponsitoryInterface $productReponsitoryInterface;

    /**
     * @param ProductReponsitoryInterface $productReponsitoryInterface
     */
    public function __construct(
        ProductReponsitoryInterface $productReponsitoryInterface
    ) {
        $this->productReponsitoryInterface = $productReponsitoryInterface;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function list(int $id): mixed
    {
        try {
            return Session::get('cart-' . $id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @return array|null
     */
    public function create(array $attributes): ?array
    {
        try {
            $id = auth()->user()->id ?? 0;

            return $this->addCart($id, $attributes);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $user_id
     * @param array $attributes
     * @return array
     */
    private function addCart(int $user_id, array $attributes): array
    {
        $carts = Session::get('cart-' . $user_id) ?? [];
        $cartFilter = array_filter($carts, function ($item) use ($attributes) {
            return ((int)$item['product_id'] ?? null) === (int)$attributes['product_id'];
        });

        if (count($cartFilter) === 0) {
            $dataCart = [
                'product_id' => $attributes['product_id'],
                'quantity'   => $attributes['quantity'],
                'name'       => $attributes['product_name'],
                'price'      => $attributes['product_price'],
                'options'    => [
                    'image'  => $attributes['product_image'],
                ],
            ];

            Session::push('cart-' . $user_id, $dataCart);
            return $dataCart;
        } else {
            $cartUpdate = array_map(function ($item) use ($attributes) {
                if ((int)$item['product_id'] === (int)$attributes['product_id']) {
                    $item['quantity'] +=  (int)$attributes['quantity'];
                }
                return $item;
            }, $carts);
            Session::put('cart-' . $user_id, $cartUpdate);
            return $cartUpdate;
        }
    }

    /**
     * @param array $request
     * @param int $id
     * @return array
     * @throws CartException
     */
    public function update(array $request, int $id): array
    {
        try {
            if (!empty($request['data'])) {
                Session::put('cart-' . $id, $request['data']);
                $carts = Session::get('cart-' . $id);
                return [
                    'code'    => StatusCodeMessage::CODE_OK,
                    'message' => StatusCodeMessage::getMessage(StatusCodeMessage::CODE_OK),
                    'data'    => $carts ?? []
                ];
            }

            return [
                'code'    => StatusCodeMessage::CODE_FAIL,
                'message' => StatusCodeMessage::getMessage(StatusCodeMessage::CODE_FAIL),
                'data'    => []
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new CartException($e->getMessage());
        }
    }
}
