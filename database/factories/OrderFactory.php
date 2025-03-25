<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'order_date' => now(),
            'total_weight' => $this->faker->randomFloat(2, 1, 10),
            'total_price' => $this->faker->randomFloat(2, 5000, 50000),
            'status' => $this->faker->randomElement(['pending', 'process', 'done', 'canceled']),
            'notes' => $this->faker->sentence(),
            'pickup' => $this->faker->boolean(),
            'delivery' => $this->faker->boolean(),
            'completed_at' => $this->faker->optional()->dateTime()
        ];
    }
}
