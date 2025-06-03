<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\UsageTracker\Commands\UpdateUsageTrackerCommand;
use Modules\UsageTracker\Handlers\UpdateUsageTrackerHandler;

class UpdateUsageTrackerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateUsageTrackerCommand(): UpdateUsageTrackerCommand
    {
        return new UpdateUsageTrackerCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
