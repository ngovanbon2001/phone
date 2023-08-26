<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryReponsitoryInterface;
    protected $productRepository;

    /**
     * @param CategoryReponsitoryInterface $repositoryInterface
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
    public function list(array $attributes)
    {
        return $this->categoryReponsitoryInterface->list($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->categoryReponsitoryInterface->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        return $this->categoryReponsitoryInterface->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        $products = $this->productRepository->where('category_id', $id)->get()->count();

        if (empty($products)) {
            return $this->categoryReponsitoryInterface->delete($id);
        }

        return Common::STATUS_INACTIVE;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->categoryReponsitoryInterface->find($id);
    }

    public function getAll() 
    {
        return $this->categoryReponsitoryInterface->getAll();
    }

    public function updateActive(array $attribute) 
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->categoryReponsitoryInterface->updateActive($attribute['id'], $value);
    }
}
