<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitTestingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        EmployeeSeeder::class,
       ]);
    }
}
