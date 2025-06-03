<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetUsageTrackerRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
