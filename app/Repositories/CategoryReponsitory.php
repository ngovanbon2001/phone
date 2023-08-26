<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryReponsitoryInterface;

class CategoryReponsitory extends BaseRepository implements CategoryReponsitoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
}
