<?php

namespace App\Services;

use App\Constants\Common;
use App\Exceptions\CartException;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderService implements OrderServiceInterface
{
    protected $orderRepository;
    protected $orderItemsRepositoryInterface;
    protected $productReponsitoryInterface;

    /**
     * @param OrderRepositoryInterface $orderRepositoryInterface
     */
    public function __construct(
        OrderRepositoryInterface      $orderRepositoryInterface,
        OrderItemsRepositoryInterface $orderItemsRepositoryInterface,
        ProductReponsitoryInterface   $productReponsitoryInterface
    ) {
        $this->orderItemsRepositoryInterface = $orderItemsRepositoryInterface;
        $this->orderRepository               = $orderRepositoryInterface;
        $this->productReponsitoryInterface   = $productReponsitoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        $attributes = [
            ["customer_name", "LIKE",  Arr::get($attributes, "inputName")],
            ["customer_phone", "LIKE", Arr::get($attributes, "inputPhone")],
            ["customer_email", "LIKE", Arr::get($attributes, "inputEmail")],
        ];

        return $this->orderItemsRepositoryInterface->list(condition($attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        DB::beginTransaction();
        try {
            $province  = DB::table('provinces')->find($attributes['provinces']);
            $districts = DB::table('districts')->find($attributes['districts']);
            $wards     = DB::table('wards')->find($attributes['wards']);

            $attribute = [
                'user_id'        => auth()->user()->id ?? null,
                'customer_name'  => $attributes['customer_name'] ?? null,
                'customer_phone' => $attributes['customer_phone'] ?? null,
                'customer_email' => $attributes['customer_email'] ?? null,
                'status'         => Common::IN_ACTIVE ?? 0,
                'address'        => ($wards->name ?? '') . ' - ' . ($districts->name ?? '') . ' - ' . ($province->name ?? ''),
                'total_money'    => array_reduce($attributes['items'] ?? [], function ($carry, $item) {
                    return $carry + ((int)$item["product_quantity"] * (float)$item["product_price"]);
                }, 0),
                'total_products' => array_reduce($attributes['items'] ?? [], function ($carry, $item) {
                    return $carry + (int)$item["product_quantity"];
                })
            ];

            $order = $this->orderRepository->create($attribute);
            $items = [];
            if ($order) {
                foreach ($attributes['items'] as $key => $value) {
                    $items[] = [
                        'order_id'         => $order->id,
                        'product_id'       => $value['product_id'],
                        'product_name'     => $value['product_name'],
                        'product_image'    => $value['product_image'],
                        'product_price'    => $value['product_price'],
                        'product_quantity' => $value['product_quantity'],
                    ];
                }

                $result = $this->orderItemsRepositoryInterface->insertOrUpdateBatch($items);

                if ($result) {
                    Mail::send('/error', ['customerName' => $attributes['customer_name'], 'totalMoney' => $attribute['total_money'],], function ($message) {
                        $message->to('bonbon2k1a@gmail.com')->subject('Order');
                    }, 'Bạn đã mua sản phẩm tại Shop');
                    Session::forget('cart-' . (auth()->user()->id ?? 0));
                    DB::commit();
                    return $order;
                }

                DB::rollBack();
                return false;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(int $id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderItemsRepositoryInterface->find($id);

            if ($order) {
                $product = $this->productReponsitoryInterface->find($order->product_id);

                if (!$product || ($order->status == Common::IN_ACTIVE && isset($product->amount) && $order->product_quantity > $product->amount)) {
                    Log::error('Fail amount');
                    return false;
                }

                $newAmount = $product->amount - $order->product_quantity;

                if ($order->status == Common::IN_ACTIVE) {
                    Log::info('Update product '. $newAmount);
                    $product->update(['amount' => $newAmount]);
                }

                $order->update(["status" => ((int)$order->status ?? 0) + 1]);
                DB::commit();
            }

            return $order;
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function cancel(int $id)
    {
        $order = $this->orderItemsRepositoryInterface->find($id);

        if ($order) {
            $order->update(['status' => Common::CANCEL]);
        }

        return $order;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->orderRepository->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->orderItemsRepositoryInterface->find($id);
    }

    public function updateActive(array $attribute)
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->orderRepository->updateActive($attribute['id'], $value);
    }

    public function count()
    {
        $month = Carbon::now()->month;
        $result = DB::table("orders")
            ->whereMonth('created_at', '=', 10)
            ->whereYear('created_at', '=', 2022)
            ->selectRaw('SUM(total_products) as total_products, SUM(total_money) as total_money')
            ->get();
        return $result->first();
    }

    public function listItem()
    {
        $result = DB::table('order_items')
            ->groupBy('product_name')
            ->groupBy('product_id')
            ->groupBy('product_image')
            ->select('product_name', DB::raw('SUM(product_quantity) as total'))
            ->orderBy('total', 'desc')
            ->paginate(Common::PAGINATE_HOME);

        return $result;
    }

    public function getOrder()
    {
        return $this->orderRepository->getOrder();
    }

    public function showListItem(mixed $order)
    {
        $result = DB::select("SELECT * FROM orders join order_items on orders.id = order_items.order_id WHERE orders.customer_email like '%" . $order->customer_email . "%' and orders.id =" . $order->id);

        return $result;
    }

    public function select_delivery(array $data)
    {
        $output = "";
        if ($data['action']) {
            if ($data['action'] == 'provinces') {
                $huyen = DB::table("districts")->where('province_id', $data['id'])->get();
                $output .= '<option value="">---Select districts---</option>';
                foreach ($huyen as $h) {
                    $output .= '<option value="' . $h->id . '">' . $h->name . '</option>';
                }
            } else {
                $xa = DB::table("wards")->where('district_id', $data['id'])->get();
                $output .= '<option value="">---Select wards---</option>';
                foreach ($xa as $x) {
                    $output .= '<option value="' . $x->id . '">' . $x->name . '</option>';
                }
            }
        }

        return $output;
    }
}
