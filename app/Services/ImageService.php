<?php

namespace App\Services;

use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Services\Contracts\ImageServiceInterface;
use App\Supports\RespondResource;

class ImageService implements ImageServiceInterface
{
    protected $imageRepositoryInterface;

    /**
     * @param ImageRepositoryInterface $imageRepositoryInterface
     */
    public function __construct(ImageRepositoryInterface $imageRepositoryInterface)
    {
        return $this->imageRepositoryInterface = $imageRepositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->imageRepositoryInterface->list($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $attribute = [];

        foreach ($attributes['image_url'] as $key => $value) {
            $attribute[] = $attributes;
            unset($attribute[$key]["_token"]);
            $attribute[$key]['image_url'] = handleImage($value);
        }

        return $this->imageRepositoryInterface->insertOrUpdateBatch($attribute);
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

        return $this->imageRepositoryInterface->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->imageRepositoryInterface->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->imageRepositoryInterface->find($id);
    }

    public function updateActive(array $attribute) 
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->imageRepositoryInterface->updateActive($attribute['id'], $value);
    }
}
