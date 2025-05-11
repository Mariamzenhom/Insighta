<?php

declare(strict_types=1);

namespace Modules\TherapySession\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\TherapySession\Models\TherapySession;

/** @extends Factory<TherapySession> */
class TherapySessionFactory extends Factory
{
    protected $model = TherapySession::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
