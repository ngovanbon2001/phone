<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryService implements CategoryServiceInterface
{
    protected CategoryReponsitoryInterface $categoryReponsitoryInterface;
    protected ProductReponsitoryInterface  $productRepository;

    /**
     * @param CategoryReponsitoryInterface $repositoryInterface
     * @param ProductReponsitoryInterface $productReponsitoryInterface
     */
    public function __construct(
        CategoryReponsitoryInterface $repositoryInterface,
        ProductReponsitoryInterface  $productReponsitoryInterface,
    )
    {
        $this->categoryReponsitoryInterface = $repositoryInterface;
        $this->productRepository            = $productReponsitoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes): mixed
    {
        try {
            return $this->categoryReponsitoryInterface->list($attributes);
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
            return $this->categoryReponsitoryInterface->create($attributes);
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
            $category = $this->categoryReponsitoryInterface->find($id);

            if ($category) {
                $category->update($attributes);
            }

            return $category;
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
            $products = $this->productRepository->where('category_id', $id)->get()->count();
            $category = $this->categoryReponsitoryInterface->find($id);

            if (!empty($products)) {
                return null;
            }

            if ($category) {
                $category->delete();
            }

            return $category;
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
            return $this->categoryReponsitoryInterface->find($id);
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
            return $this->categoryReponsitoryInterface->getAll();
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

            return $this->categoryReponsitoryInterface->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
