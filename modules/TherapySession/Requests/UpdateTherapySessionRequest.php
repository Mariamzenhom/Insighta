<?php

declare(strict_types=1);

namespace Modules\TherapySession\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\TherapySession\Commands\UpdateTherapySessionCommand;
use Modules\TherapySession\Handlers\UpdateTherapySessionHandler;

class UpdateTherapySessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateTherapySessionCommand(): UpdateTherapySessionCommand
    {
        return new UpdateTherapySessionCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
