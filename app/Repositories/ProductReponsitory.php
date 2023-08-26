<?php

namespace App\Repositories;

use App\Constants\Common;
use App\Models\Product;
use App\Repositories\Contracts\ProductReponsitoryInterface;

class ProductReponsitory extends BaseRepository implements ProductReponsitoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }

    public function listProduct(array $conditions, int $paginate = Common::PAGINATE_BE)
    {
        $this->applyConditions(condition($conditions));
        return $this->model
                    ->orderBy('sort_order', 'ASC')
                    ->paginate($paginate);
    }

    /**
     * get list product
     * @param array $conditions
     * @return array
     */
    public function getProduct()
    {
        return $this->model
                    ->select('id', 'name', 'amount')
                    ->orderBy('amount','DESC')
                    ->paginate(Common::PAGINATE_HOME);
    }
}
