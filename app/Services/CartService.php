<?php

namespace App\Services;

use App\Constants\StatusCodeMessage;
use App\Exceptions\CartException;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\CartServiceInterface;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class CartService implements CartServiceInterface
{
    protected $bannerRepository;
    protected $productReponsitoryInterface;

    /**
     * @param BannerRepositoryInterface $bannerRepository
     */
    public function __construct(
        BannerRepositoryInterface    $bannerRepository,
        ProductReponsitoryInterface  $productReponsitoryInterface
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->productReponsitoryInterface = $productReponsitoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(int $id)
    {
        // Session::flush();
        // dd(Session::get('cart-' . $id));
        return Session::get('cart-' . $id);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $user_id = auth()->user()->id ?? 0;

        return $this->addCart($user_id, $attributes);
    }

    private function addCart($user_id, $attributes)
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
        } else {
            $cartUpdate = array_map(function ($item) use ($attributes) {
                if ((int)$item['product_id'] === (int)$attributes['product_id']) {
                    (int)$item['quantity'] +=  (int)$attributes['quantity'];
                }
                return $item;
            }, $carts);
            Session::put('cart-' . $user_id, $cartUpdate);
        }
    }

    /**
     * @param array $dataCart
     * @param int $id
     * @return mixed
     */
    public function update(array $request, int $id)
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
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::error($e->getMessage());
            throw new CartException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->bannerRepository->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->bannerRepository->find($id);
    }

    public function updateActive(array $attribute)
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->bannerRepository->updateActive($attribute['id'], $value);
    }
}
