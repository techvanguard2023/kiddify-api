<?php

namespace Database\Seeders;

use App\Models\FeaturePlan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PlanSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(FeaturePlanSeeder::class);
    }
}
