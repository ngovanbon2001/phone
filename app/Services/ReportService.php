<?php

namespace App\Services;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Services\Contracts\ReportServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class ReportService implements ReportServiceInterface
{
    protected ReportRepositoryInterface $reportRepositoryInterface;

    /**
     * @param ReportRepositoryInterface $reportRepositoryInterface
     */
    public function __construct(ReportRepositoryInterface $reportRepositoryInterface)
    {
        return $this->reportRepositoryInterface = $reportRepositoryInterface;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function list(array $attributes): mixed
    {
        try {
            return $this->reportRepositoryInterface->list($attributes);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        try {
            return $this->reportRepositoryInterface->create($attributes);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): mixed
    {
        try {
            $report = $this->reportRepositoryInterface->find($id);

            if ($report) {
                $report->update($attributes);
            }

            return $report;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function delete(int $id): mixed
    {
        try {
            $report = $this->reportRepositoryInterface->find($id);

            if ($report) {
                $report->delete();
            }

            return $report;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function detail(int $id): mixed
    {
        try {
            return $this->reportRepositoryInterface->find($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    public function updateActive(array $attribute)
    {
        try {
            $value = [
                "active" => $attribute['status']
            ];

            return $this->reportRepositoryInterface->updateActive($attribute['id'], $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }
}
