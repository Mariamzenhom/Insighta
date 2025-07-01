<?php

declare(strict_types=1);

namespace Modules\DailyReport\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\DailyReport\Presenters\DailyReportPresenter;
use Modules\DailyReport\Requests\CreateDailyReportRequest;
use Modules\DailyReport\Requests\GetDailyReportListRequest;
use Modules\DailyReport\Services\DailyReportCRUDService;
use Ramsey\Uuid\Uuid;

class DailyReportController extends Controller
{
    public function __construct(
        private DailyReportCRUDService $dailyReportService,
    ) {
    }

    public function index(GetDailyReportListRequest $request):JsonResponse
    {
        $list = $this->dailyReportService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(DailyReportPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function store(CreateDailyReportRequest $request): JsonResponse
    {
        $createdItem = $this->dailyReportService->create($request->createCreateDailyReportDTO());

        $presenter = new DailyReportPresenter($createdItem);

        return Json::buildItems('daily_report', $presenter->getData());
    }
}
