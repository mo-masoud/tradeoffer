<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => fake()->name(),
            'name_ar' => fake('ar_SA')->name(),
            'description_en' => fake()->sentence(),
            'description_ar' => fake('ar_SA')->sentence(),
            'image' => 'store.avif',
            'is_active' => true,
        ];
    }
}
