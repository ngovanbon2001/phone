<?php

namespace App\Service;

use App\Repositories\TestRepositoryEloquent;
use App\Service\Contract\IExample;

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