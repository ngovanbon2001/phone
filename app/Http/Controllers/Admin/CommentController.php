<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Services\Contracts\ReportServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
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
     * Show the form for editing the specified resource.
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $comment = $this->reportService->list([]);

        return view('admin.comment.show', compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = $this->reportService->delete($id);

        return $this->handleViewResponse(
            $category,
            'comment',
            __('languages.'.Common::ACTION_DELETE). ' '.strtolower(__($this->action))
        );
    }
}
