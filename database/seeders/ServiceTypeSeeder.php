<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceTypes = [
            ['name' => 'Independent Medical Evaluation (IME)'],
            ['name' => 'Permanancy Evaluation'],
            ['name' => 'Fit for Duty Evaluation'],
            ['name' => 'Medical Evaluation (State of DE only)'],
            ['name' => 'Impairment Rating Evaluation (IRE)'],
            ['name' => 'Review Services'],
            ['name' => 'Medical Records Prepping and Nurse Clinical Review'],
            ['name' => 'Medical Records Prepping Only'],
            ['name' => 'Other'],
        ];

       ServiceType::truncate();
       ServiceType::insert($serviceTypes);
    }
}
