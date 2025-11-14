<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FeaturePlan;

class FeaturePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $featurePlans = [
            [
                'feature_id' => 1,
                'plan_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 2,
                'plan_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 3,
                'plan_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 4,
                'plan_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 1,
                'plan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 2,
                'plan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 3,
                'plan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'feature_id' => 4,
                'plan_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($featurePlans as $featurePlan) {
            FeaturePlan::create($featurePlan);
        }
    }
}
