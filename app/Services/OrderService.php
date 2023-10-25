<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderService implements OrderServiceInterface
{
    protected OrderRepositoryInterface      $orderRepository;
    protected OrderItemsRepositoryInterface $orderItemsRepositoryInterface;
    protected ProductReponsitoryInterface   $productReponsitoryInterface;

    /**
     * @param OrderRepositoryInterface $orderRepositoryInterface
     * @param OrderItemsRepositoryInterface $orderItemsRepositoryInterface
     * @param ProductReponsitoryInterface $productReponsitoryInterface
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
    public function list(array $attributes): mixed
    {
        try {
            $attributes = [
                ["customer_name", "LIKE",  Arr::get($attributes, "customer_name")],
                ["customer_phone", "LIKE", Arr::get($attributes, "customer_phone")],
                ["customer_email", "LIKE", Arr::get($attributes, "customer_email")],
            ];

            return $this->orderRepository->list(condition($attributes));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();
        try {
            $province  = DB::table('provinces')->find($attributes['provinces']);
            $districts = DB::table('districts')->find($attributes['districts']);
            $wards     = DB::table('wards')->find($attributes['wards']);
            $emailContent = "Bạn đã mua hàng thành công! Dưới đây là danh sách sản phẩm bạn đã mua:\n\n";

            $attribute = [
                'user_id'        => auth()->user()->id ?? null,
                'customer_name'  => $attributes['customer_name'] ?? null,
                'customer_phone' => $attributes['customer_phone'] ?? null,
                'customer_email' => $attributes['customer_email'] ?? null,
                'status'         => Common::IN_ACTIVE ?? 0,
                'address' => ($attributes['address_detail'] ?? '') .' - '. ($wards->name ?? '') . ' - ' . ($districts->name ?? '') . ' - ' . ($province->name ?? ''),
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
                $total = 0;
                foreach ($attributes['items'] as $value) {
                    $items[] = [
                        'order_id'         => $order->id,
                        'product_id'       => $value['product_id'],
                        'product_name'     => $value['product_name'],
                        'product_image'    => $value['product_image'],
                        'product_price'    => $value['product_price'],
                        'product_quantity' => $value['product_quantity'],
                        'color'            => $value['color'] ?? '',
                    ];
                    $total = $total + ($value['product_quantity'] * $value['product_price']);
                    $emailContent .= "Tên sản phẩm: {$value['product_name']}\n";
                    $emailContent .= "Số lượng: {$value['product_quantity']}\n";
                    $emailContent .= "Giá: {$value['product_price']} $\n";
                    $emailContent .= "-------------------------\n";
                }

                $emailContent .= "Tổng: {$total} $\n";

                $result = $this->orderItemsRepositoryInterface->insertOrUpdateBatch($items);

                if ($result) {
                    // Send email
                    Mail::raw($emailContent, function ($message) use ($attributes) {
                        $message->to($attributes['customer_email'] ?? null)->subject('Order Confirmation');
                    });

                    Session::forget('cart-' . (auth()->user()->id ?? 0));
                    DB::commit();
                    return $order;
                }
            }
            DB::rollBack();
            return $order;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update(int $id): mixed
    {
        DB::beginTransaction();
        try {
            $order = $this->orderItemsRepositoryInterface->find($id);

            if ($order) {
                $product = $this->productReponsitoryInterface->find($order->product_id);

                if (
                    !$product || ($order->status == Common::IN_ACTIVE
                        && isset($product->amount)
                        && $order->product_quantity > $product->amount)
                ) {
                    Log::error('Fail amount');
                    return null;
                }

                $newAmount = $product->amount - $order->product_quantity;

                if ($order->status == Common::IN_ACTIVE) {
                    Log::info('Update product ' . $newAmount);
                    $product->update(['amount' => $newAmount]);
                }

                $order->update(["status" => ((int)$order->status ?? 0) + 1]);
                DB::commit();
            }

            return $order;
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function cancel(int $id): mixed
    {
        DB::beginTransaction();
        try {
            $order = $this->orderItemsRepositoryInterface->find($id);

            if ($order) {
                $product = $this->productReponsitoryInterface->find($order->product_id);

                if ($order->status > Common::IN_ACTIVE) {
                    $newAmount = ($product->amount ?? 0) + ($order->product_quantity ?? 0);
                    $product->update(['amount' => $newAmount]);
                }

                $order->update(['status' => Common::CANCEL]);
            }

            DB::commit();
            return $order;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function delete(int $id): mixed
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->find($id);

            if ($order) {
                $count = $this->orderItemsRepositoryInterface->findWhere([
                    ['order_id', '=', $id],
                    ['status', '<', Common::ORDER_HIDDEN]
                ])->count();

                if ($count == Common::IN_ACTIVE) {
                    $this->orderItemsRepositoryInterface->where([
                        ['order_id', '=', $id],
                    ])->delete();

                    $order->delete();
                    DB::commit();
                } else {
                    return null;
                }
            }

            return $order;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * show items order
     * @param int $id
     * @return mixed
     */
    public function detail(int $id): mixed
    {
        try {
            return $this->orderRepository->find($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * detail order
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        try {
            return $this->orderRepository->find($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attribute
     * @return mixed
     */
    public function updateActive(array $attribute): mixed
    {
        try {
            $value = [
                "active" => $attribute['status']
            ];

            return $this->orderRepository->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return mixed|null
     */
    public function count(): mixed
    {
        try {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;

            $result = DB::table("orders")
                ->whereMonth('created_at', '=', $month)
                ->whereYear('created_at', '=', $year)
                ->selectRaw('SUM(total_products) as total_products, SUM(total_money) as total_money')
                ->get();

            return $result->first();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return LengthAwarePaginator|null
     */
    public function listItem(): ?LengthAwarePaginator
    {
        try {
            return DB::table('order_items')
                ->groupBy('product_name')
                ->groupBy('product_id')
                ->groupBy('product_image')
                ->select('product_name', DB::raw('SUM(product_quantity) as total'))
                ->orderBy('total', 'desc')
                ->paginate(Common::PAGINATE_HOME);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getOrder(): mixed
    {
        try {
            return $this->orderRepository->getOrder();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param mixed $order
     * @return array|null
     */
    public function showListItem(mixed $order): ?array
    {
        try {
            return DB::select(
                "SELECT * FROM orders join order_items on orders.id = order_items.order_id WHERE orders.customer_email like '%" . $order->customer_email . "%' and orders.id =" . $order->id
            );
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $data
     * @return string
     */
    public function select_delivery(array $data): string
    {
        $output = "";
        if ($data['action']) {
            if ($data['action'] == 'provinces') {
                $huyen = DB::table("districts")->where('province_id', $data['id'])->get();
                $output .= '<option value="">---'. __('languages.districts') .'---</option>';
                foreach ($huyen as $h) {
                    $output .= '<option value="' . $h->id . '">' . $h->name . '</option>';
                }
            } else {
                $xa = DB::table("wards")->where('district_id', $data['id'])->get();
                $output .= '<option value="">---'. __('languages.wards') .'---</option>';
                foreach ($xa as $x) {
                    $output .= '<option value="' . $x->id . '">' . $x->name . '</option>';
                }
            }
        }

        return $output;
    }

    /**
     * show items order
     * @param int $id
     * @return mixed
     */
    public function detailItem(int $id): mixed
    {
        try {
            return $this->orderItemsRepositoryInterface->find($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * delete item
     * @param int $id
     * @return mixed|null
     */
    public function deleteItem(int $id): mixed
    {
        try {
            $item = $this->orderItemsRepositoryInterface->find($id);

            if ($item) {
                $item->update(['status' => Common::ORDER_HIDDEN]);
            }

            return $item;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * get list order by user
     * @param int $id
     * @return mixed|null
     */
    public function findByUser(int $id): mixed
    {
        try {
            return $this->orderRepository->findWhere([
                ['user_id', '=', $id],
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
