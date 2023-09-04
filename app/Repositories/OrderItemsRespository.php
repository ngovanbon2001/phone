<?php

namespace App\Repositories;

use App\Constants\Common;
use App\Models\Order_item;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;

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
     * @return array
     */
    public function list(array $conditions, int $paginate = Common::PAGINATE_BE)
    {
        $this->applyConditions(condition($conditions));
        return $this->model
                    ->paginate(Common::PAGINATE_BE);
    }
}
