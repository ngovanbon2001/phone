<?php

namespace App\Repositories;

use App\Constants\Common;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRespository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Order::class;
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

    /**
     * get top order
     * @param array $conditions
     * @return array
     */
    public function getOrder()
    {
        return $this->model
                    ->orderBy('total_money','DESC')
                    ->paginate(Common::PAGINATE_HOME);
    }
}
