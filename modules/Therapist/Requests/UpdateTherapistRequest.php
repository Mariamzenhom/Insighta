<?php

declare(strict_types=1);

namespace Modules\Therapist\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Therapist\Commands\UpdateTherapistCommand;
use Modules\Therapist\Handlers\UpdateTherapistHandler;

class UpdateTherapistRequest extends FormRequest
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
            'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function createUpdateTherapistCommand(): UpdateTherapistCommand
    {
        return new UpdateTherapistCommand(
            id: Uuid::fromString($this->route('id')),
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
