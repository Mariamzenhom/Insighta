<?php

declare(strict_types=1);

namespace Modules\Therapist\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetTherapistRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
