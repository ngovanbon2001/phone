<?php
namespace App\Repositories\Contracts;

use App\Constants\Common;

interface ProductReponsitoryInterface extends RepositoryInterface
{
    public function listProduct(array $conditions, int $paginate = Common::PAGINATE_BE);
    public function getProduct();
}