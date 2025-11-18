<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guard = 'employee';
        $permissions = [
            "role-list",
            "role-create",
            "role-edit",
            "role-delete",
            "employee-list",
            "employee-create",
            "employee-edit",
            "employee-delete",
            "customer-list",
            "customer-create",
            "customer-edit",
            "customer-delete",
            "item-list",
            "item-create",
            "item-edit",
            "item-delete",
            "address-list",
            "address-create",
            "address-edit",
            "address-delete",
            "order-list",
            "order-create",
            "order-edit",
            "order-delete",
            "payment-list",
            "payment-create",
            "payment-edit",
            "payment-delete",
        ];

        foreach($permissions as $key => $permission){
          Permission::firstOrCreate([
           'name' => $permission,
           'guard_name' => $guard,
          ]);
        }
    }
}
