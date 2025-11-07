<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{

     protected $model = Item::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 1. Title: Use sentence() for short, readable, title-like text
        'title' => $this->faker->sentence(mt_rand(3, 8)), 
        
        // 2. Description: Use paragraph() or text() for longer body content
        'description' => $this->faker->paragraph(mt_rand(3, 6)),
        ];
    }
}
