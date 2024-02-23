<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PassportClientSeeder;
use Database\Seeders\MasterData\RoleSeeder;
use Database\Seeders\MasterData\EmployeeSeeder;
use Database\Seeders\MasterData\PermissionSeeder;

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
        RoleSeeder::class,
        PermissionSeeder::class,
       ]);
    }
}
