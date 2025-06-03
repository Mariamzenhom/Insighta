<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Presenters;

use Modules\UsageTracker\Models\UsageTracker;
use BasePackage\Shared\Presenters\AbstractPresenter;

class UsageTrackerPresenter extends AbstractPresenter
{
    private UsageTracker $usageTracker;

    public function __construct(UsageTracker $usageTracker)
    {
        $this->usageTracker = $usageTracker;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->usageTracker->id,
            'name' => $this->usageTracker->name,
        ];
    }
}
