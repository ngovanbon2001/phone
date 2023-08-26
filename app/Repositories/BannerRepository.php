<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\Contracts\BannerRepositoryInterface;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Banner::class;
    }
}
