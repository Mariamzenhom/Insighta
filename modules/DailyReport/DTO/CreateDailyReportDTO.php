<?php

declare(strict_types=1);

namespace Modules\DailyReport\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateDailyReportDTO
{
    public function __construct(
        public string $user_id,
        public string $report,
        public string $status,
        public string $type
    ) {
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'report' => $this->report,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
