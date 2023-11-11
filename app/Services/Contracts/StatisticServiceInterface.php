<?php

namespace App\Services\Contracts;

use App\Constants\Common;

interface StatisticServiceInterface
{
    public function listItem(array $condition = []);
    public function getOrder(array $condition = []);
    public function getProduct(array $condition = []);
}
