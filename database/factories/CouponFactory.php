<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->unique()->bothify('??##??##')),
            'value' => fake()->randomElement([5, 10, 15, 20, 25]),
            'expiration_date' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'limit' => fake()->numberBetween(1, 100),
            'used_count' => 0,
            'is_active' => true,
        ];
    }
}
