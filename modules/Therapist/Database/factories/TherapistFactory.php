<?php

declare(strict_types=1);

namespace Modules\Therapist\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Therapist\Models\Therapist;

/** @extends Factory<Therapist> */
class TherapistFactory extends Factory
{
    protected $model = Therapist::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
