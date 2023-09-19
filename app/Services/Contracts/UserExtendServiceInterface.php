<?php

namespace App\Services\Contracts;

interface UserExtendServiceInterface
{
    public function send(array $attributes);
    public function update(array $attributes);
}