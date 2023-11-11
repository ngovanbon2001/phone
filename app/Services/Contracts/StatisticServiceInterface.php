<?php

namespace App\Services\Contracts;

use App\Constants\Common;

interface StatisticServiceInterface
{
    public function listItem(array $condition = [], int $paginate = Common::PAGINATE_HOME);
    public function getOrder(array $condition = [], int $paginate = Common::PAGINATE_HOME);
    public function getProduct(array $condition = [], int $paginate = Common::PAGINATE_HOME);
}
