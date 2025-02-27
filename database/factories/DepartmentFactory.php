<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Generates a random department name
            'description' => $this->faker->sentence(10), // Generates a short random description
            'status' => $this->faker->randomElement([1, 0]) // Randomly assigns active or inactive
        ];
    }
}
