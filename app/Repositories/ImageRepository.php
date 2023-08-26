<?php

namespace App\Repositories;

use App\Models\Product_image;
use App\Repositories\Contracts\ImageRepositoryInterface;
/**
 * Class ImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Product_image::class;
    }
}
