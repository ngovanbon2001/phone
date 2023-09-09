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
    protected $userRepository;
    protected $adminRepositoryInterface;
    protected $userTempRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param AdminRepositoryInterface $adminRepositoryInterface
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
    public function list(array $attributes)
    {
        return $this->adminRepositoryInterface->list($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $attributes["password"] = Hash::make($attributes["password"]);
        
        return $this->adminRepositoryInterface->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        if (isset($attributes["password"])) {
            $attributes["password"] = Hash::make($attributes["password"]);
        }
        return $this->adminRepositoryInterface->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->adminRepositoryInterface->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->adminRepositoryInterface->find($id);
    }

    public function updateActive(array $attribute) 
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->userRepository->updateActive($attribute['id'], $value);
    }

    public function countUser()
    {
        return $this->userRepository->countUser();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createUser(array $attributes)
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

    private function handleBuildAttribute(array $attribute)
    {
        return [
            'username' => $attribute['username'],
            'phone'    => $attribute['phone'],
            'email'    => $attribute['email'],
            'password' => Hash::make($attribute["password"]),
        ];
    }
}
