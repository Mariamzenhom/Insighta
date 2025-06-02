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
            'specialty' => 'required|',
            'rating' => 'required|',
            'price' => 'required|',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }


    public function createCreateTherapistDTO(): CreateTherapistDTO
    {
        return new CreateTherapistDTO(
            specialty:$this->get('specialty'),
            rating:$this->get('rating'),
            price:$this->get('price'),
            name:$this->get('name'),
            phone:$this->get('phone'),
            email:$this->get('email'),
            file: $this->file('file')
        );
    }
}
