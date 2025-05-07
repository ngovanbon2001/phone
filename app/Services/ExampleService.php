<?php

namespace App\Services;

use App\Repositories\TestRepositoryEloquent;
use App\Services\Contracts\IExample;

class ExampleService implements IExample
{
    public $testRepositoryEloquent;

    public function __construct(TestRepositoryEloquent $testRepositoryEloquent)
    {
        $this->testRepositoryEloquent = $testRepositoryEloquent;
    }

    public function getAll()
    {
        return $this->testRepositoryEloquent->getAll();
    }
}
