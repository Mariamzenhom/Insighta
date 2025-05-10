<?php

declare(strict_types=1);

namespace Modules\DailyReport\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DailyReport\Models\DailyReport;

/** @extends Factory<DailyReport> */
class DailyReportFactory extends Factory
{
    protected $model = DailyReport::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
