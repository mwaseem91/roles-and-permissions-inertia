<?php

namespace Database\Seeders;

use App\Models\ClaimType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClaimTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $claimTypes = [
            ['name' => 'Liability - Auto 3rd Party / Bodily Injury'],
            ['name' => 'Auto 1st Party / Personal Injury Protection-No Fault'],
            ['name' => 'Disability - Long Term'],
            ['name' => 'Disability - Short Term'],
            ['name' => 'Fit For Duty'],
            ['name' => 'General Liability'],
            ['name' => 'Workers Compensation'],
            ['name' => 'Federal (Longshore)']
        ];

        // Truncate the claim_types table
        ClaimType::truncate();

        // Insert claim types into the database
        ClaimType::insert($claimTypes);
    }
}
