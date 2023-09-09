<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ProductService implements ProductServiceInterface
{
    protected ProductReponsitoryInterface $productReponsitory;

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
    public function list(array $attributes): mixed
    {
        try {
            $attributes = [
                ["name", "LIKE", Arr::get($attributes, "name")],
                ["brand_id", "=", Arr::get($attributes, "brand")],
                ["category_id", "=", Arr::get($attributes, "category")],
                ["is_new", "=", Arr::get($attributes, "isNew")],
                ["is_best_sell", "=", Arr::get($attributes, "bestSell")],
            ];

            return $this->productReponsitory->listProduct(condition($attributes));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        try {
            if (isset($attributes['image_url'])) {
                $image = $attributes['image_url'];

                $attributes['image_url'] = handleImage($image);
            } else {
                $attributes['image_url'] = "no-image.png";
            }

            $attributes['specifications'] = convertJson($attributes['specifications']);

            return $this->productReponsitory->create($attributes);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): mixed
    {
        try {
            if (isset($attributes['image_url'])) {
                $image = $attributes['image_url'];

                $attributes['image_url'] = handleImage($image);
            } else {
                $attributes['image_url'] = $attributes['oldImage'];
            }

            $attributes['specifications'] = convertJson($attributes['specifications']);

            return $this->productReponsitory->update($attributes, $id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function delete(int $id): mixed
    {
        try {
            $product = $this->productReponsitory->find($id);

            if ($product) {
                $product->delete();
            }

            return $product;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id): mixed
    {
        try {
            $result = $this->productReponsitory->find($id);

            $result['specifications'] = decodeJson($result['specifications']);

            return $result;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attribute
     * @return mixed
     */
    public function updateActive(array $attribute): mixed
    {
        try {
            $value = [
                "active" => $attribute['status']
            ];

            return $this->productReponsitory->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getProduct(): mixed
    {
        try {
            return $this->productReponsitory->getProduct();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function getProductFE(array $conditions): mixed
    {
        try {
            return $this->productReponsitory->listProduct($conditions, Common::PAGINATE_FE);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
