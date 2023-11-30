<?php

namespace App\Http\Controllers\Web;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateRequest;
use App\Services\Contracts\ReportServiceInterface;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    private string $action = 'languages.review';
    protected ReportServiceInterface $reportService;

    /**
     * @param ReportServiceInterface  $reportService
     */
    public function __construct(
        ReportServiceInterface  $reportService,
    ) {
        $this->reportService  = $reportService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        //create comment
        $comment = $this->reportService->create($request->all());

        return $this->handleViewResponseToBack($comment, __('languages.'.Common::ACTION_CREATE). ' '.strtolower(__($this->action)));
    }
}
