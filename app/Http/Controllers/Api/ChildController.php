<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Child;

class ChildController extends Controller
{
    public function index(Request $request)
    {
        // Retorna todos os filhos do usuário autenticado com seus relacionamentos
        return $request->user()->children()->with(['tasks', 'rewards', 'taskHistory'])->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'sex' => 'required|in:male,female',
        ]);

        $child = $request->user()->children()->create([
            'name' => $validatedData['name'],
            'age' => $validatedData['age'],
            'sex' => $validatedData['sex'],
            'avatar_url' => 'https://picsum.photos/seed/' . urlencode($validatedData['name']) . '/200',
            'points' => 0,
        ]);

        return response()->json($child->load(['tasks', 'rewards', 'taskHistory']), 201);
    }
}