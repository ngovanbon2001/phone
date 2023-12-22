<?php

namespace App\Services;

use App\Constants\Common;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Services\Contracts\ColorServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class ColorService implements ColorServiceInterface
{
    protected ColorRepositoryInterface $colorRepositoryInterface;
    protected OrderItemsRepositoryInterface $orderItemsRepository;

    /**
     * @param ColorRepositoryInterface $colorRepositoryInterface
     * @param OrderItemsRepositoryInterface $orderItemsRepository
     */
    public function __construct(
        ColorRepositoryInterface $colorRepositoryInterface,
        OrderItemsRepositoryInterface $orderItemsRepository,
    )
    {
        $this->colorRepositoryInterface = $colorRepositoryInterface;
        $this->orderItemsRepository     = $orderItemsRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes): mixed
    {
        try {
            return $this->colorRepositoryInterface->list($attributes);
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
            return $this->colorRepositoryInterface->create($attributes);
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
            $version = $this->colorRepositoryInterface->find($id);

            if ($version) {
                $version->update($attributes);
            }

            return $version;
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
            $count = $this->orderItemsRepository->findWhere(['color' => $id])->count();
            if ($count > Common::COUNT_DELETE) {
                return null;
            }
            
            $version = $this->colorRepositoryInterface->find($id);

            if ($version) {
                $version->delete();
            }

            return $version;
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
            return $this->colorRepositoryInterface->find($id);
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

            return $this->colorRepositoryInterface->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
