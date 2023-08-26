<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    protected $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepositoryInterface
     */
    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        return $this->orderRepository = $orderRepositoryInterface;
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

        return $this->orderRepository->list(condition($attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->orderRepository->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        return $this->orderRepository->update($attributes, $id);
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
        return $this->orderRepository->find($id);
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
