<?php

declare(strict_types=1);

namespace Modules\TherapySession\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\TherapySession\DTO\CreateTherapySessionDTO;


class CreateTherapySessionRequest extends FormRequest
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

    public function createDTO(): CreateTherapySessionDTO
    {
        $authUser = auth('api')->user();
        return new CreateTherapySessionDTO(
            user_id: (string) ( $authUser->id),
            therapist_id: $this->input('therapist_id'),
            session_time: $this->input('session_time'),
            notes: $this->input('notes'),
            is_paid: (bool)$this->input('is_paid'),
        );
    }
}
