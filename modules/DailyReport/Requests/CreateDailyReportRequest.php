<?php

declare(strict_types=1);

namespace Modules\DailyReport\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\DailyReport\DTO\CreateDailyReportDTO;

class CreateDailyReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|string|exists:users,id',
            'report'=> 'required|string',
            'status'=> 'required|string',
            'type' =>'required'
        ];
    }

    public function createCreateDailyReportDTO(): CreateDailyReportDTO
    {
        return new CreateDailyReportDTO(
            user_id: $this->get('user_id'),
            report: $this->get('report'),
            status: $this->get('status'),
            type: $this->get('type')
        );
    }
}
