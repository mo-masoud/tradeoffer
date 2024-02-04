<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => fake()->word(),
            'name_ar' => fake('ar/SA')->word(),
            'image' => 'category.png',
            'parent_id' => null,
            'order' => 1,
            'is_active' => true,
        ];
    }
}