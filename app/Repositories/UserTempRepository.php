<?php

namespace App\Repositories;

use App\Models\UsersTemp;
use App\Repositories\Contracts\UserTempRepositoryInterface;

class UserTempRepository extends BaseRepository implements UserTempRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UsersTemp::class;
    }
}
