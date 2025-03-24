<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'price_per_kg' => $this->faker->optional()->randomFloat(2, 5000, 20000),
            'price_per_item' => $this->faker->optional()->randomFloat(2, 5000, 50000),
            'estimated_time' => $this->faker->numberBetween(12, 72),
            'category_id' => \App\Models\Categories::factory(),
            'is_active' => $this->faker->boolean(90),
            'image_url' => $this->faker->imageUrl(640, 480, 'laundry'),
        ];
    }

    
}
