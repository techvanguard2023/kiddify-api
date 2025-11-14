<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $features = [
            [
                'name' => 'Crianças ilimitadas',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Tarefas e recompensas personalizadas',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Acompanhamento de progresso com gráficos',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Controle financeiro e extrato de pontos',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
