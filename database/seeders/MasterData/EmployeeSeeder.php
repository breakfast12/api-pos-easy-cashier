<?php

namespace Database\Seeders\MasterData;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Seed the application's database for employee.
     */
    public function run(): void
    {
        $employee = [
            [
                'id' => Str::uuid(),
                'name' => 'Momoko Milada',
                'email' => 'momokomilada@mailinator.com',
                'password' => Hash::make('superadmin123'),
                'phone' => '081247290821',
                'gender' => 'Female',
                'created_by' => 'Momoko Milada',
                'created_at' => Carbon::now()
            ]
        ];

        Employee::insert($employee);
    }
}
