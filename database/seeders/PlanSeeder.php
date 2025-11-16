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
                'price' => 9.90,
                'period' => 'monthly',
                'is_free' => false,
                'popular' => false,
                'stripe_price_id' => 'price_1STY77LUVZl7M7WaJSl94QUN',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Anual',
                'description' => 'Economize 2 meses com o plano anual!',
                'price' => 99.00,
                'period' => 'yearly',
                'is_free' => false,
                'popular' => true,
                'stripe_price_id' => 'price_1STY85LUVZl7M7WaBHtDkHB7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
