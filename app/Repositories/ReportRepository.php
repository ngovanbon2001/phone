<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Comment::class;
    }
}
