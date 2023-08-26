<?php

namespace App\Repositories\Contract;

use App\Repositories\Contract\RepositoryInterface;

/**
 * Interface TestRepository.
 *
 * @package namespace App\Repositories;
 */
interface TestRepository extends RepositoryInterface
{
    public function getAll();
}
