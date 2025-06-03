<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\UsageTracker\Models\UsageTracker;

/**
 * @property UsageTracker $model
 * @method UsageTracker findOneOrFail($id)
 * @method UsageTracker findOneByOrFail(array $data)
 */
class UsageTrackerRepository extends BaseRepository
{
    public function __construct(UsageTracker $model)
    {
        parent::__construct($model);
    }

    public function getUsageTrackerList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getUsageTracker(UuidInterface $id): UsageTracker
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createUsageTracker(array $data): UsageTracker
    {
        return $this->create($data);
    }

    public function updateUsageTracker(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteUsageTracker(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}
