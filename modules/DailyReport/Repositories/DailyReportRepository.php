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

public function paginated(
    array $conditions = [],
    int $page = 1,
    int $perPage = 15,
    string $orderBy = 'created_at',
    string $sortBy = 'desc'
) {
    if (method_exists($this->model, 'scopeFilter')) {
        $query = $this->model->filter(request()->all());
    } else {
        $query = $this->model->newQuery();
    }

    foreach ($conditions as $field => $value) {
        if (is_array($value)) {
            $query->whereIn($field, $value);
        } else {
            $query->where($field, $value);
        }
    }

    $count = $query->count();
    $paginatedData = $query->forPage($page, $perPage)->orderBy($orderBy, $sortBy)->get();
    $paginationArray = $this->getPaginationInformation($page, $perPage, $count);

    return [
        'pagination' => $paginationArray['pagination'],
        'data' => $paginatedData,
    ];
}

}
