<?php

declare(strict_types=1);

namespace Modules\TherapySession\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateTherapySessionCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $therapist_id,
        private string $session_time,
        private ?string $notes = null,
        private bool $is_paid = false
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }


    public function toArray(): array
    {
        return array_filter([
            'therapist_id' => $this->therapist_id,
            'session_time' => $this->session_time,
            'notes' => $this->notes,
            'is_paid' => $this->is_paid,
        ]);
    }
}
