<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Services;

use Illuminate\Support\Collection;
use Modules\UsageTracker\DTO\CreateUsageTrackerDTO;
use Modules\UsageTracker\Models\UsageTracker;
use Modules\UsageTracker\Repositories\UsageTrackerRepository;
use Ramsey\Uuid\UuidInterface;

class UsageTrackerCRUDService
{
    public function __construct(
        private UsageTrackerRepository $repository,
    ) {
    }

    public function create(CreateUsageTrackerDTO $createUsageTrackerDTO): UsageTracker
    {
         return $this->repository->createUsageTracker($createUsageTrackerDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): UsageTracker
    {
        return $this->repository->getUsageTracker(
            id: $id,
        );
    }
}
