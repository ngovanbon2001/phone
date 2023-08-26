<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Services\Contracts\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{
    protected $brandRepository;
    protected $productRepository;

    /**
     * @param BrandRepositoryInterface $repositoryInterface
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
    public function list(array $attributes)
    {
        return $this->brandRepository->list($attributes);
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

        return $this->brandRepository->create($attributes);
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
            $attributes['image_url'] = $attributes['imageOld'];
        }

        return $this->brandRepository->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        $products = $this->productRepository->where('brand_id', $id)->get()->count();

        if (empty($products)) {
            return $this->brandRepository->delete($id);
        }

        return Common::STATUS_INACTIVE;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->brandRepository->find($id);
    }

    public function getAll()
    {
        return $this->brandRepository->getAll();
    }

    public function updateActive(array $attribute) 
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->brandRepository->updateActive($attribute['id'], $value);
    }
}
