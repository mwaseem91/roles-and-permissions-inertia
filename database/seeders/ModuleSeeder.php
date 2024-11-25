<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module = [
            [
                'id' => '1',
                'name' => 'Module'
            ],
            [
                'id' => '2',
                'name' => 'Permission'
            ],
            [
                'id' => '3',
                'name' => 'Role'
            ],
            [
                'id' => '4',
                'name' => 'User'
            ],
            [
                'id' => '5',
                'name' => 'Form Request'
            ],
            
           
        ];
        Module::truncate();
        // Store All Module in Database
        foreach ($module as $item) {
            Module::create($item);
        }
    
    }
}
