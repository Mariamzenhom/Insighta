<?php

declare(strict_types=1);

namespace Modules\Therapist\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Therapist\DTO\CreateTherapistDTO;

class CreateTherapistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|',
            'specialty' => 'required|',
            'rating' => 'required|',
            'price' => 'required|',
        ];
    }

    public function createCreateTherapistDTO(): CreateTherapistDTO
    {
        return new CreateTherapistDTO(
            user_id:$this->get('user_id'),
            specialty:$this->get('specialty'),
            rating:$this->get('rating'),
            price:$this->get('price'),
        );
    }
}
