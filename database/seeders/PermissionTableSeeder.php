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
       
        // Define permissions
        $permissions = [
            ['name' => 'role-view', 'module_id' => 1],
            ['name' => 'role-create', 'module_id' => 1],
            ['name' => 'role-edit', 'module_id' => 1],
            ['name' => 'role-show', 'module_id' => 1],
            ['name' => 'role-update', 'module_id' => 1],
            ['name' => 'role-delete', 'module_id' => 1],

            ['name' => 'user-view', 'module_id' =>2],
            ['name' => 'user-create', 'module_id' =>2],
            ['name' => 'user-edit', 'module_id' =>2],
            ['name' => 'user-show', 'module_id' =>2],
            ['name' => 'user-update', 'module_id' =>2],
            ['name' => 'user-delete', 'module_id' =>2],

            ['name' => 'request-form-view', 'module_id' => 3],
            ['name' => 'request-form-create', 'module_id' => 3],
            ['name' => 'request-form-edit', 'module_id' => 3],
            ['name' => 'request-form-show', 'module_id' => 3],
            ['name' => 'request-form-assign', 'module_id' => 3],
            ['name' => 'request-form-update', 'module_id' => 3],
            ['name' => 'request-form-delete', 'module_id' => 3],
        ];

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the permissions table
        Permission::query()->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert permissions
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
