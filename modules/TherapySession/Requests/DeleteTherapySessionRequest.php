<?php

declare(strict_types=1);

namespace Modules\TherapySession\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteTherapySessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
