<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\College>
 */
class CollegeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = College::class;

    public function definition(): array
    {
        return [
            'CollegeName' => $this->faker->company,
            'CollegeCode' => strtoupper($this->faker->lexify('???')), // Example: ABC
            'IsActives' => true,
        ];
    }
}
