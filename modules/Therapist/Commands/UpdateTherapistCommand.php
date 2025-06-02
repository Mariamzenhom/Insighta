<?php

declare(strict_types=1);

namespace Modules\Therapist\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateTherapistCommand
{
    public function __construct(
        private UuidInterface $id,
        private ?string $specialty = null,
        private ?string $rating = null,
        private ?string $price = null,
        private ?string $name = null,
        private ?string $phone = null,
        private ?string $email = null,
        private ?\Illuminate\Http\UploadedFile $file = null
    ) {
    }

    public function getId(): UuidInterface
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
            'specialty' => $this->specialty,
            'rating' => $this->rating,
            'price' => $this->price,
            'phone' => $this->phone,
            'email' => $this->email,
            'file' => $this->file,
        ]);
    }
}
