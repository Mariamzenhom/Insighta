<?php

declare(strict_types=1);

namespace Modules\TherapySession\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateTherapySessionDTO
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $therapist_id,
        public readonly string $session_time,
        public readonly ?string $notes,
        public readonly bool $is_paid,
    ) {
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'therapist_id' => $this->therapist_id,
            'session_time' => $this->session_time,
            'notes' => $this->notes,
            'is_paid' => $this->is_paid,
        ];
    }
}
