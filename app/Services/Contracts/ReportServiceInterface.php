<?php

namespace App\Services\Contracts;

interface ReportServiceInterface
{
    public function list(array $attributes);

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function delete(int $id);

    public function detail(int $id);

    public function updateActive(array $attribute);
}