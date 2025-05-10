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
            'name' => 'required|string',
        ];
    }

    public function createUpdateTherapistCommand(): UpdateTherapistCommand
    {
        return new UpdateTherapistCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
