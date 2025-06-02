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
            'therapist_id' => 'required|exists:therapists,id',
            'session_time' => 'required|date_format:Y-m-d H:i',
            'notes' => 'nullable|string',
            'is_paid' => 'nullable|boolean',
        ];
    }

    public function createUpdateTherapySessionCommand(): UpdateTherapySessionCommand
    {
        return new UpdateTherapySessionCommand(
            id: Uuid::fromString($this->route('id')),
            therapist_id: $this->get('therapist_id'),
            session_time: $this->get('session_time'),
            notes: $this->get('notes'),
            is_paid: (bool)$this->get('is_paid')
        );
    }
}
