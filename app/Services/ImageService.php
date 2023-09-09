<?php

namespace App\Services;

use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Services\Contracts\ImageServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class ImageService implements ImageServiceInterface
{
    protected ImageRepositoryInterface $imageRepositoryInterface;

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
    public function list(array $attributes): mixed
    {
        try {
            return $this->imageRepositoryInterface->list($attributes);
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
            $attribute = [];

            foreach ($attributes['image_url'] as $key => $value) {
                $attribute[] = $attributes;
                unset($attribute[$key]["_token"]);
                $attribute[$key]['image_url'] = handleImage($value);
            }

            return $this->imageRepositoryInterface->insertOrUpdateBatch($attribute);
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

            $images = $this->imageRepositoryInterface->find($id);

            if ($images) {
                $images->update($attributes);
            }

            return $images;
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
            $image = $this->imageRepositoryInterface->find($id);

            if ($image) {
                $image->delete();
            }

            return $image;
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
            return $this->imageRepositoryInterface->find($id);
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

            return $this->imageRepositoryInterface->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
