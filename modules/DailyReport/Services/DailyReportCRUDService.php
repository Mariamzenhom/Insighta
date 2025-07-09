<?php

declare(strict_types=1);

namespace Modules\DailyReport\Services;

use Illuminate\Support\Collection;
use Modules\DailyReport\DTO\CreateDailyReportDTO;
use Modules\DailyReport\Models\DailyReport;
use Modules\DailyReport\Repositories\DailyReportRepository;
use Ramsey\Uuid\UuidInterface;

class DailyReportCRUDService
{
    public function __construct(
        private DailyReportRepository $repository,
    ) {
    }

    public function create(CreateDailyReportDTO $createDailyReportDTO): DailyReport
    {
         return $this->repository->createDailyReport($createDailyReportDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        $userId = [];

        if (auth()->user()->child_id !== null) {
            $userId[] = auth()->user()->id;
            $userId[] = auth()->user()->child_id;
        } else {
            $userId[] = auth()->user()->id;
        }

        return $this->repository->paginated(
            ['user_id' => $userId],
            page: $page,
            perPage: $perPage
        );
    }
    public function get(UuidInterface $id): DailyReport
    {
        return $this->repository->getDailyReport(
            id: $id,
        );
    }



}
