<?php

namespace App\Repositories;

use App\Constants\Common;
use App\Models\Order_item;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderItemsRespository extends BaseRepository implements OrderItemsRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Order_item::class;
    }

    /**
     * list paginate
     * @param array $conditions
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function list(array $conditions, int $paginate = Common::PAGINATE_BE): LengthAwarePaginator
    {
        $this->applyConditions(condition($conditions));
        return $this->model
                    ->orderBy('id', 'DESC')
                    ->paginate(Common::PAGINATE_BE);
    }
}
