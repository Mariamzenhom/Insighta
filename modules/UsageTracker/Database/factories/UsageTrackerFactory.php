<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UsageTracker\Models\UsageTracker;

/** @extends Factory<UsageTracker> */
class UsageTrackerFactory extends Factory
{
    protected $model = UsageTracker::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
