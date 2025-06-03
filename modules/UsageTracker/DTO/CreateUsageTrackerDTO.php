<?php

declare(strict_types=1);

namespace Modules\UsageTracker\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateUsageTrackerDTO
{
    public function __construct(
        public string $name,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
