<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\AddressSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\PaymentSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

       // 1. Core independent models (must exist first)
        $this->call([
            AddressSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class, 
            ItemSeeder::class,
        ]);


        // 2. Orders (Dependent on Customer and Item)
        // These records must be finalized before payments can reference them.
        $this->call([
            OrderSeeder::class,
        ]);


        // 3. Payments (Dependent on Customer and Order)
        $this->call([
            PaymentSeeder::class,
        ]);
    }
}
