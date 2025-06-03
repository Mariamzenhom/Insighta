<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteUsageTrackerRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
