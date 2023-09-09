<?php

namespace App\Services;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Services\Contracts\BannerServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class BannerService implements BannerServiceInterface
{
    protected BannerRepositoryInterface $bannerRepository;

    /**
     * @param BannerRepositoryInterface $bannerRepository
     */
    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        return $this->bannerRepository = $bannerRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes): mixed
    {
        try {
            return $this->bannerRepository->list($attributes);
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

            return $this->bannerRepository->create($attributes);
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

            $banner = $this->bannerRepository->find($id);

            if ($banner) {
                $banner->update($attributes);
            }

            return $banner;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        try {
            $banner = $this->bannerRepository->find($id);

            if ($banner) {
                $banner->delete();
            }

            return $banner;
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
            return $this->bannerRepository->find($id);
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

            return $this->bannerRepository->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
