<?php

declare(strict_types=1);

namespace Modules\DailyReport\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetDailyReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
