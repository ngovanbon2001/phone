<?php

namespace App\Services;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Services\Contracts\ReportServiceInterface;

class ReportService implements ReportServiceInterface
{
    protected $reportRepositoryInterface;

    /**
     * 
     */
    public function __construct(ReportRepositoryInterface $reportRepositoryInterface)
    {
        return $this->reportRepositoryInterface = $reportRepositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes)
    {
        return $this->reportRepositoryInterface->list($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->reportRepositoryInterface->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        return $this->reportRepositoryInterface->update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->reportRepositoryInterface->delete($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id)
    {
        return $this->reportRepositoryInterface->find($id);
    }

    public function updateActive(array $attribute) 
    {
        $value = [
            "active" => $attribute['status']
        ];

        return $this->reportRepositoryInterface->updateActive($attribute['id'], $value);
    }
}
