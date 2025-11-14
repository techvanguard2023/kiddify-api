<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Reward;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class RewardController extends Controller
{
    public function store(Request $request, Child $child)
    {
        Gate::authorize('update', $child);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pointsRequired' => 'required|integer|min:1',
        ]);
        
        // Renomeia a chave para corresponder ao banco de dados
        $validatedData['points_required'] = $validatedData['pointsRequired'];
        unset($validatedData['pointsRequired']);

        $reward = $child->rewards()->create($validatedData);

        return response()->json($reward, 201);
    }

    public function claim(Request $request, Child $child, Reward $reward)
    {
        Gate::authorize('update', $child);

        if ($child->points < $reward->points_required) {
            throw ValidationException::withMessages([
                'points' => ['Pontos insuficientes para resgatar esta recompensa.'],
            ]);
        }

        $child->decrement('points', $reward->points_required);
        $reward->delete();

        return response()->json($child->fresh('rewards'));
    }
}