<?php

declare(strict_types=1);

namespace Modules\Therapist\DTO;

use Ramsey\Uuid\UuidInterface;
use Illuminate\Http\UploadedFile;

class CreateTherapistDTO
{
    public function __construct(
        public string $specialty,
        public string $rating,
        public string $price,
        public string $name,
        public string $phone,
        public string $email,
        public UploadedFile  $file,
    ) {
    }

    public function toArray(): array
    {
        return [
            'specialty'=>$this->specialty,
            'rating'=>$this->rating,
            'price'=>$this->price,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'email'=>$this->email,
        ];
    }
}
