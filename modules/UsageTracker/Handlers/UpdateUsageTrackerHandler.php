<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Handlers;

use Modules\UsageTracker\Commands\UpdateUsageTrackerCommand;
use Modules\UsageTracker\Repositories\UsageTrackerRepository;

class UpdateUsageTrackerHandler
{
    public function __construct(
        private UsageTrackerRepository $repository,
    ) {
    }

    public function handle(UpdateUsageTrackerCommand $updateUsageTrackerCommand)
    {
        $this->repository->updateUsageTracker($updateUsageTrackerCommand->getId(), $updateUsageTrackerCommand->toArray());
    }
}
