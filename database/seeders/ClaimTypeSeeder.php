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
            'Liability - Auto 3rd Party / Bodily Injury',
            'Auto 1st Party / Personal Injury Protection-No Fault',
            'Disability - Long Term',
            'Disability - Short Term',
            'Fit For Duty',
            'General Liability',
            'Workers Compensation',
            'Federal (Longshore)'
        ];

        foreach ($claimTypes as $type) {
            ClaimType::create(['name' => $type]);
        }
    }
}
