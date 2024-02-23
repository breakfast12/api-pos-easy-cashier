<?php

namespace Database\Seeders\MasterData;

use App\Models\Role;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = Employee::where('email', 'momokomilada@mailinator.com')->first();
        $roles = [
            [
                'uuid' => Str::uuid(),
                'name' => 'Admin',
                'guard_name' => 'api',
                'created_by' => $employee->id,
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Cashier',
                'guard_name' => 'api',
                'created_by' => $employee->id,
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Barista',
                'guard_name' => 'api',
                'created_by' => $employee->id,
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Store Manager',
                'guard_name' => 'api',
                'created_by' => $employee->id,
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Kitchen Staff',
                'guard_name' => 'api',
                'created_by' => $employee->id,
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Stock Manager',
                'guard_name' => 'api',
                'created_by' => $employee->id,
            ],
        ];

        Role::insert($roles);
    }
}
