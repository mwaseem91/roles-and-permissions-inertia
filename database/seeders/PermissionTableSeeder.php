<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'Role-index',
            'Role-create',
            'Role-edit',
            'Role-show',
            'Role-delete',

            'Request-form-index',
            'Request-form-create',
            'Request-form-edit',
            'Request-form-show',
            'Request-form-delete',



        ];

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the permissions table
        Permission::query()->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
