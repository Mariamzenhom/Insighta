<?php

declare(strict_types=1);

namespace Modules\DailyReport\Presenters;

use Modules\DailyReport\Models\DailyReport;
use BasePackage\Shared\Presenters\AbstractPresenter;

class DailyReportPresenter extends AbstractPresenter
{
    private DailyReport $dailyReport;

    public function __construct(DailyReport $dailyReport)
    {
        $this->dailyReport = $dailyReport;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->dailyReport->id,
            'report' => $this->dailyReport->report,
            'status' => $this->dailyReport->status,
            'type' => $this->dailyReport->type,
            'user' => $this->dailyReport->user,
        ];
    }
}
