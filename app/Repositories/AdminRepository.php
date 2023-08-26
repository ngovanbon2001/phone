<?php

namespace App\Repositories;

use App\Constants\Common;
use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Admin::class;
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

    public function countUser() 
    {
        return $this->model->count();
    }
}
