<?php

namespace App\Services;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\BrandServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class BrandService implements BrandServiceInterface
{
    protected BrandRepositoryInterface    $brandRepository;
    protected ProductReponsitoryInterface $productRepository;

    /**
     * @param BrandRepositoryInterface    $repositoryInterface
     * @param ProductReponsitoryInterface $productReponsitoryInterface
     */
    public function __construct(
        BrandRepositoryInterface    $repositoryInterface,
        ProductReponsitoryInterface $productReponsitoryInterface,
    )
    {
        $this->brandRepository   = $repositoryInterface;
        $this->productRepository = $productReponsitoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes): mixed
    {
        try {
            return $this->brandRepository->list($attributes);
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

            return $this->brandRepository->create($attributes);
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
                $attributes['image_url'] = $attributes['imageOld'];
            }

            $brand = $this->brandRepository->find($id);

            if ($brand) {
                $brand->update($attributes);
            }

            return $brand;
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
            $products = $this->productRepository->where('brand_id', $id)->get()->count();
            $brand    = $this->brandRepository->find($id);

            if (!empty($products)) {
                return null;
            }

            if ($brand) {
                $brand->delete();
            }

            return $brand;
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
            return $this->brandRepository->find($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed
    {
        try {
            return $this->brandRepository->getAll();
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

            return $this->brandRepository->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
