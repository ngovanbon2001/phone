<?php

namespace App\Services\Contracts;

interface OrderServiceInterface
{
    public function list(array $attributes);

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function delete(int $id);

    public function detail(int $id);

    public function updateActive(array $attribute);

    public function count();

    public function listItem();

    public function getOrder();

    public function showListItem(mixed $order);

    public function select_delivery(array $data);
}