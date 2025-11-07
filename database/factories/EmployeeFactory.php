<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Employee;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        
        return [
            // 1. Name Fields - Now using the defined variables
            'first_name' => $firstName,
            
            // Reusing $lastName for constructing the email and then using it for last_name
            'last_name' => $lastName,
            
            'middle_name' => $this->faker->randomElement([
                null, 
                $this->faker->randomLetter(), 
                $this->faker->firstName(),
            ]),
            
            // 2. Email (Using the names to make the email more realistic, e.g., john.doe@example.com)
            'email' => strtolower("{$firstName}.{$lastName}@" . $this->faker->domainName()),
            
            // 3. Password 
            'password' => Hash::make('password'), 

            // 4. Phone (Must be unique)
            'phone' => $this->faker->unique()->phoneNumber(),
            'address_id' => Address::inRandomOrder()->first()->id,
            
            // 5. Employee ID (Placeholder/Factory-generated unique number)
            'employee_id' => 'EMP-' . $this->faker->unique()->randomNumber(4, true),
        ];
    }
}
