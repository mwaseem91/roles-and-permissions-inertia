<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        DB::table('roles')->truncate();

        // Truncate the model_has_roles table as well
        DB::table('model_has_roles')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create the Admin role
        $role = Role::create(['name' => 'Admin']);

        // Get all permissions
        $permissions = Permission::pluck('id', 'id')->all();

        // Assign all permissions to the Admin role
        $role->syncPermissions($permissions);

        // Create an Admin user and assign the role
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $user->assignRole($role);
    }
}
