<?php

namespace App\Services;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $adminRepositoryInterface;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param AdminRepositoryInterface $adminRepositoryInterface
     */
    public function __construct (
        UserRepositoryInterface $userRepository,
        AdminRepositoryInterface $adminRepositoryInterface
    )
    {
        $this->userRepository           = $userRepository;
        $this->adminRepositoryInterface = $adminRepositoryInterface;
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
}
