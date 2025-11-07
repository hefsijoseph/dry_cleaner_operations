<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Item;
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
    public function definition(): array
    {
        return [
            'order_name' => 'INV-' 
                    . $this->faker->date('Ymd') 
                    . '-' 
                    . $this->faker->unique()->randomNumber(3),
            'item_id' => Item::inRandomOrder()->first()->id,
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'employee_id' => Employee::inRandomOrder()->first()->id,
        ];
    }
}
