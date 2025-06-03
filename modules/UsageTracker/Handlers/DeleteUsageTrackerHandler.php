<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Handlers;

use Modules\UsageTracker\Repositories\UsageTrackerRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteUsageTrackerHandler
{
    public function __construct(
        private UsageTrackerRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteUsageTracker($id);
    }
}
