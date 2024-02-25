<?php

namespace Database\Seeders\MasterData;

use App\Models\Role;
use App\Models\Employee;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'process payments',
            'manage orders',
            'view orders',
            'update order status',
            'view reports',
            'manage users',
            'manage inventory',
            'view kitchen orders',
            'update kitchen order status',
            'view inventory reports',
            'manage order vendors',
            'manage all',
        ];

        // Insert to DB
        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName, 'guard_name' => 'api']);
        }

        // Assign Permission to Role
        $cashier = Role::findByName('Cashier', 'api');
        $cashier->givePermissionTo(['process payments', 'manage orders']);

        $barista = Role::findByName('Barista', 'api');
        $barista->givePermissionTo(['view orders', 'update order status']);

        $storeManager = Role::findByName('Store Manager', 'api');
        $storeManager->givePermissionTo([
            'view reports',
            'manage users',
            'manage inventory',
            'manage orders',
            'process payments'
        ]);

        $kitchenStaff = Role::findByName('Kitchen Staff', 'api');
        $kitchenStaff->givePermissionTo(['view orders', 'update order status']);

        $stockManager = Role::findByName('Stock Manager', 'api');
        $stockManager->givePermissionTo(['manage inventory', 'view inventory reports', 'manage order vendors']);

        $admin = Role::findByName('Admin', 'api');
        $admin->givePermissionTo('manage all');
    }
}
