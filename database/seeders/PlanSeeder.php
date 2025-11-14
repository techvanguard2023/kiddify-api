<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;



class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $plans = [
            [
                'name' => 'Mensal',
                'description' => 'Flexibilidade total. Cancele quando quiser.',
                'price' => 19.00,
                'period' => 'monthly',
                'is_free' => false,
                'popular' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Anual',
                'description' => 'Economize 2 meses com o plano anual!',
                'price' => 190.00,
                'period' => 'yearly',
                'is_free' => false,
                'popular' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
