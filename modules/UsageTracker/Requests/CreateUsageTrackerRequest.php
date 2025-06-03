<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\UsageTracker\DTO\CreateUsageTrackerDTO;

class CreateUsageTrackerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateUsageTrackerDTO(): CreateUsageTrackerDTO
    {
        return new CreateUsageTrackerDTO(
            name: $this->get('name'),
        );
    }
}
