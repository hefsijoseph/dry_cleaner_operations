<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer; 

use Illuminate\Support\Facades\Hash; // Necessary for hashing the password

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

     protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => $this->faker->name(),

            // Ensure emails are unique for your database constraint
            'email' => $this->faker->unique()->safeEmail(),
            
            // Generate a simple password (e.g., 'password') and hash it
            'password' => Hash::make('password'), 
            
            // Generate a fake phone number
            'phone' => $this->faker->unique()->phoneNumber(),
            'address_id' => Address::inRandomOrder()->first()->id,

        ];
    }
}
