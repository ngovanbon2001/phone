<?php

namespace App\Repositories;

use App\Constants\Common;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
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
