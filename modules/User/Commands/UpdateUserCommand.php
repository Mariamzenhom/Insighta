<?php

declare(strict_types=1);

namespace Modules\User\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateUserCommand
{
    public function __construct(
        private  $id,
        private string $name,
        private ?string $email = null
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}
