<?php

namespace App\Services\Contracts;

interface ProductServiceInterface
{
    public function list(array $attributes);

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function delete(int $id);
    
    public function detail(int $id);

    public function updateActive(array $attribute);

    public function getProduct();

    public function getProductFE(array $conditions);
}