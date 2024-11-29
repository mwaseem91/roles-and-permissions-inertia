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
                'name' => 'Role'
            ],
            [
                'id' => '2',
                'name' => 'User'
            ],
            [
                'id' => '3',
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
