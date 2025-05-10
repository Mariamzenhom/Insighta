<?php

declare(strict_types=1);

namespace Modules\Therapist\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateTherapistDTO
{
    public function __construct(
        public string $user_id,
        public string $specialty,
        public string $rating,
        public string $price,
    ) {
    }

    public function toArray(): array
    {
        return [
            'user_id'=>$this->user_id,
            'specialty'=>$this->specialty,
            'rating'=>$this->rating,
            'price'=>$this->price,
        ];
    }
}
