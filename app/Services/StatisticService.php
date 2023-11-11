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
     * @param int $paginate
     * @return LengthAwarePaginator|null
     */
    public function listItem(array $condition = [], int $paginate = Common::PAGINATE_HOME): ?LengthAwarePaginator
    {
        try {
            return DB::table('order_items')
                ->where(condition($condition))
                ->groupBy('product_name')
                ->groupBy('product_id')
                ->groupBy('product_image')
                ->select('product_name', DB::raw('SUM(product_quantity) as total'))
                ->orderBy('total', 'desc')
                ->paginate($paginate);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $condition
     * @param int $paginate
     * @return LengthAwarePaginator|null
     */
    public function getOrder(array $condition = [], int $paginate = Common::PAGINATE_HOME): ?LengthAwarePaginator
    {
        try {
            return DB::table('orders')
                ->where(condition($condition))
                ->orderBy('total_money','DESC')
                ->paginate($paginate);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $condition
     * @param int $paginate
     * @return LengthAwarePaginator|null
     */
    public function getProduct(array $condition = [], int $paginate = Common::PAGINATE_HOME): ?LengthAwarePaginator
    {
        try {
            return DB::table('products')
                ->select('id', 'name', 'created_at')
                ->selectRaw('(SELECT SUM(amount_color) FROM product_color WHERE product_color.product_id = products.id) AS amount')
                ->orderBy('amount', 'DESC')
                ->paginate($paginate);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
