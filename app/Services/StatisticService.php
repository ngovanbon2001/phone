<?php

namespace App\Services;

use App\Constants\Common;
use App\Services\Contracts\StatisticServiceInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatisticService implements StatisticServiceInterface
{
    /**
     * @param array $condition
     * @return LengthAwarePaginator|null
     */
    public function listItem(array $condition = []): ?LengthAwarePaginator
    {
        try {
            return DB::table('order_items')
                ->groupBy('product_name')
                ->groupBy('product_id')
                ->groupBy('product_image')
                ->select('product_name', DB::raw('SUM(product_quantity) as total'))
                ->orderBy('total', 'desc')
                ->paginate($condition['paginate-item'] ?? Common::PAGINATE_HOME);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $condition
     * @return LengthAwarePaginator|null
     */
    public function getOrder(array $condition = []): ?LengthAwarePaginator
    {
        try {
            $query = DB::table('orders');
            if (isset($condition['start-date-order']) && isset($condition['end-date-order'])) {
                $query = DB::table('orders')
                    ->whereBetween('created_at', [$condition['start-date-order'], $condition['end-date-order']]);
            }
            return $query->selectRaw('DATE(created_at) as date, MONTH(created_at) as month, SUM(total_money) as total, SUM(total_products) as amount')
                ->groupBy('date', 'month')
                ->orderBy('date','ASC')
                ->paginate($condition['paginate-order'] ?? Common::PAGINATE_HOME);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $condition
     * @return LengthAwarePaginator|null
     */
    public function getProduct(array $condition = []): ?LengthAwarePaginator
    {
        try {
            $query = DB::table('products');
            if (isset($condition['start-date-product']) && isset($condition['end-date-product'])) {
                $query = DB::table('products')
                        ->whereBetween('created_at', [$condition['start-date-product'], $condition['end-date-product']]);
            }
            return $query
                ->select('id', 'name', 'created_at')
                ->selectRaw('(SELECT SUM(amount_color) FROM product_color WHERE product_color.product_id = products.id) AS amount')
                ->orderBy('amount', 'DESC')
                ->paginate($condition['paginate-product'] ?? Common::PAGINATE_HOME);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
