<?php

namespace Database\Factories;

use App\Models\Console;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Console>
 */
class ConsoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['PlayStation 5', 'Xbox Series X', 'Nintendo Switch', 'PlayStation 4', 'Xbox One']),
            'brand' => fake()->randomElement(['Sony', 'Microsoft', 'Nintendo']),
            'daily_price' => fake()->randomFloat(2, 10, 50),
            'ability' => fake()->boolean(80),
        ];
    }
}
