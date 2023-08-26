<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository as RepositoriesBaseRepository;
use App\Repositories\Contract\TestRepository;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TestRepositoryEloquent extends RepositoriesBaseRepository implements TestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    
    public function getAll()
    {
        $this->applyConditions([]);
        return $this->model->get();
    }
}
