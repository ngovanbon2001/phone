<?php

namespace App\Services\Contracts;

interface UserTempServiceInterface
{
    public function create(array $attributes);

    public function delete(int $id);

    public function show(int $id);
}
