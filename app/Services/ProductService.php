<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService implements ProductServiceInterface
{
    protected ProductReponsitoryInterface $productReponsitory;
    protected ColorRepositoryInterface    $colorRepositoryInterface;

    /**
     * @param ProductReponsitoryInterface $repositoryInterface
     * @param ColorRepositoryInterface $colorRepositoryInterface
     */
    public function __construct(
        ProductReponsitoryInterface $repositoryInterface,
        ColorRepositoryInterface    $colorRepositoryInterface
    )
    {
        $this->productReponsitory       = $repositoryInterface;
        $this->colorRepositoryInterface = $colorRepositoryInterface;
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
        DB::beginTransaction();
        try {
           $attribute = $this->convertAttribute($attributes);

            $product = $this->productReponsitory->create($attribute);

            if (!$product) {
                return null;
            }

            $this->colorRepositoryInterface->create([
                'product_id'   => $product['id'] ?? 0,
                'color'        => $attributes['color'] ?? '',
                'amount_color' => $attributes['amount'] ?? 0,
            ]);

            DB::commit();
            return $product;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return null;
        }
    }

    private function convertAttribute(array $attributes)
    {
        if (isset($attributes['image_url'])) {
            $image = $attributes['image_url'];

            $attribute['image_url'] = handleImage($image);
        } else {
            if ($attributes['oldImage']) {
                $attributes['image_url'] = $attributes['oldImage'];
            } else {
                $attribute['image_url'] = "no-image.png";
            }
        }

        $attribute['specifications'] = convertJson($attributes['specifications']);
        $attribute['category_id']    = $attributes['category_id'] ?? 0;
        $attribute['brand_id']       = $attributes['brand_id'] ?? 0;
        $attribute['name']           = $attributes['name'] ?? '';
        $attribute['price']          = $attributes['price'] ?? 0;
        $attribute['old_price']      = $attributes['old_price'] ?? null;
        $attribute['description']    = $attributes['description'] ?? null;
        $attribute['tags']           = $attributes['tags'] ?? null;
        $attribute['is_best_sell']   = $attributes['is_best_sell'] ?? 0;
        $attribute['is_new']         = $attributes['is_new'] ?? 0;
        $attribute['sort_order']     = $attributes['sort_order'] ?? 0;
        $attribute['active']         = $attributes['active'] ?? 0;

        return $attribute ?? [];
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): mixed
    {
        try {
            $attribute = $this->convertAttribute($attributes);

            return $this->productReponsitory->update($attribute, $id);
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
            $conditions = [
                ["name", "LIKE", Arr::get($conditions, "name")],
                ["brand_id", "=", Arr::get($conditions, "brand_id")],
                ["category_id", "=", Arr::get($conditions, "category_id")],
                ["is_new", "=", Arr::get($conditions, "is_new")],
                ["active", "=", Common::ACTIVE],
                ["price", "<", Arr::get($conditions, "price")],
                ["tags", "LIKE", Arr::get($conditions, "tags")],
            ];

            return $this->productReponsitory->listProduct($conditions, Common::PAGINATE_FE);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getTags(): mixed
    {
        try {
            return DB::table('products')
                        ->select('tags', DB::raw('count(*) as count'))
                        ->whereNotNull('tags')
                        ->groupBy('tags')
                        ->orderBy('count', 'desc')
                        ->take(Common::PAGINATE_BE)
                        ->get();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
