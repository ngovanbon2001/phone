<?php

namespace App\Repositories;

use App\Models\Product_color;
use App\Repositories\Contracts\ColorRepositoryInterface;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Product_color::class;
    }
}
