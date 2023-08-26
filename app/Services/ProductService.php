<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Support\Arr;

class ProductService implements ProductServiceInterface
{
    protected $productReponsitory;

    /**
     * @param ProductReponsitoryInterface $repositoryInterface
     */
    public function __construct(ProductReponsitoryInterface $repositoryInterface)
    {
        return $this->productReponsitory = $repositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        $attributes = [
            ["name", "LIKE", Arr::get($attributes, "name")],
            ["brand_id", "=", Arr::get($attributes, "brand")],
            ["category_id", "=", Arr::get($attributes, "category")],
            ["is_new", "=", Arr::get($attributes, "isNew")],
            ["is_best_sell", "=", Arr::get($attributes, "bestSell")],
        ];

        return $this->productReponsitory->listProduct(condition($attributes));
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = "no-image.png";
        }
        
        $attributes['specifications'] = convertJson($attributes['specifications']);

        return $this->productReponsitory->create($attributes);
    }


    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attributes['image_url'] = handleImage($image);
        } else {
            $attributes['image_url'] = $attributes['oldImage'];
        }

        $attributes['specifications'] = convertJson($attributes['specifications']);

        return $this->productReponsitory->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->productReponsitory->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        $result = $this->productReponsitory->find($id);

        $result['specifications'] = decodeJson($result['specifications']);

        return $result;
    }

    public function updateActive(array $attribute) 
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->productReponsitory->updateActive($attribute['id'], $value);
    }

    public function getProduct()
    {
        return $this->productReponsitory->getProduct();
    }

    public function getProductFE(array $conditions)
    {
        return $this->productReponsitory->listProduct($conditions, Common::PAGINATE_FE);
    }
}
