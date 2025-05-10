<?php

declare(strict_types=1);

namespace Modules\DailyReport\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\DailyReport\Models\DailyReport;

/**
 * @property DailyReport $model
 * @method DailyReport findOneOrFail($id)
 * @method DailyReport findOneByOrFail(array $data)
 */
class DailyReportRepository extends BaseRepository
{
    public function __construct(DailyReport $model)
    {
        parent::__construct($model);
    }

    public function getDailyReportList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getDailyReport(UuidInterface $id): DailyReport
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createDailyReport(array $data): DailyReport
    {
        return $this->create($data);
    }

    public function updateDailyReport(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteDailyReport(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}
