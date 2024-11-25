<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\ClaimTypeSeeder;
use Database\Seeders\ServiceTypeSeeder;
use Database\Seeders\SpecialtiesSeeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\PermissionTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            ClaimTypeSeeder::class,
            ServiceTypeSeeder::class,
            StateSeeder::class,
            SpecialtiesSeeder::class,
           
        ]);
    }
}
