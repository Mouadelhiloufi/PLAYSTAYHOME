<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'The Last of Us',
                'God of War',
                'Halo Infinite',
                'Forza Horizon 5',
                'Mario Kart 8',
                'Zelda: Breath of the Wild',
                'Spider-Man',
                'Uncharted 4',
                'FIFA 24',
                'Call of Duty'
            ]),
            'genre' => fake()->randomElement([
                'Action',
                'Adventure',
                'RPG',
                'Sport',
                'Racing',
                'FPS',
                'Platformer'
            ]),
        ];
    }
}
