<?php

namespace App\Services;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\UserTempRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;
    protected AdminRepositoryInterface $adminRepositoryInterface;
    protected UserTempRepositoryInterface $userTempRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param AdminRepositoryInterface $adminRepositoryInterface
     * @param UserTempRepositoryInterface $userTempRepository
     */
    public function __construct (
        UserRepositoryInterface     $userRepository,
        AdminRepositoryInterface    $adminRepositoryInterface,
        UserTempRepositoryInterface $userTempRepository,
    )
    {
        $this->userRepository           = $userRepository;
        $this->adminRepositoryInterface = $adminRepositoryInterface;
        $this->userTempRepository       = $userTempRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes): mixed
    {
        try {
            return $this->adminRepositoryInterface->list($attributes);
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
            $attributes["password"] = Hash::make($attributes["password"]);

            return $this->adminRepositoryInterface->create($attributes);
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
            $admin = $this->adminRepositoryInterface->find($id);

            if (isset($attributes["password"])) {
                $attributes["password"] = Hash::make($attributes["password"]);
            }

            if ($admin) {
                $admin->update($attributes);
            }

            return $admin;
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
            $admin = $this->adminRepositoryInterface->find($id);

            if ($admin) {
                $admin->delete();
            }

            return $admin;
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
            return $this->adminRepositoryInterface->find($id);
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

            return $this->userRepository->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function countUser(): mixed
    {
        try {
            return $this->userRepository->countUser();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createUser(array $attributes): mixed
    {
        DB::beginTransaction();
        try {
            $conditions = [
                'code'  => $attributes['code'] ?? null,
                'email' => $attributes['email'] ?? null,
            ];

            $userTemp = $this->userTempRepository->findWhereFirst($conditions);

            if ($userTemp) {
                $result = $this->userRepository->create($this->handleBuildAttribute($userTemp->toArray()));
                $userTemp->delete();
                DB::commit();
                return $result;
            }

            DB::rollBack();
            return null;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * @param array $attribute
     * @return array
     */
    private function handleBuildAttribute(array $attribute): array
    {
        return [
            'username' => $attribute['username'],
            'phone'    => $attribute['phone'],
            'email'    => $attribute['email'],
            'password' => Hash::make($attribute["password"]),
        ];
    }
}
