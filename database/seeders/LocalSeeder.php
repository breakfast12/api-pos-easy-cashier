<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PassportClientSeeder;
use Database\Seeders\MasterData\EmployeeSeeder;

class LocalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        EmployeeSeeder::class,
        PassportClientSeeder::class,
       ]);
    }
}
