<?php
namespace App\Repositories\Contracts;

use App\Constants\Common;

interface OrderItemsRepositoryInterface extends RepositoryInterface
{
    public function list(array $conditions, int $paginate = Common::PAGINATE_BE);
}