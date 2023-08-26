<?php

namespace App\Repositories\Contracts;

use App\Constants\Common;

interface RepositoryInterface extends \Prettus\Repository\Contracts\RepositoryInterface
{
    public function findWhereForUpdate(array $conditions, $columns = ['*']);

    public function findWhereFirst(array $conditions, $columns = ['*']);

    public function insertOrUpdateBatch($records, array $exclude = []);

    public function deleteMultipleRecord(array $conditions);

    public function updateMultipleRecord(array $values);

    public function updateByWhere(array $conditions, array $value);

    public function list(array $conditions, int $paginate = Common::PAGINATE_BE);

    public function updateActive(int $id, array $attribute); 

    public function getAll();
}
