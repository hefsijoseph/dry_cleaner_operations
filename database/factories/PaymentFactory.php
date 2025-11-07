<?php

namespace Database\Factories;

use App\Models\Customer;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{

      protected $model = Payment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 1. Item Weight (Numerical/Decimal)
        // Generates a float between 0.5 and 50.0 with 2 decimal places.
        'item_weight_kg' => $this->faker->randomFloat(2, 0.5, 50), 
        
        // 2. Cost (Numerical/Decimal for currency)
        // Generates a float representing currency (e.g., 12.55 to 999.99).
        'cost' => $this->faker->randomFloat(2, 10, 1000),
        
        // 3. Is Paid (Boolean)
        // Generates a boolean (true or false). You can optionally define the likelihood.
        'is_paid' => $this->faker->boolean(70), // 70% chance of being TRUE (paid)

        'order_id' => Order::inRandomOrder()->first()->id,
        'customer_id' => Customer::inRandomOrder()->first()->id,
        ];
    }
}
