<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Task;
use App\Models\TaskLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function store(Request $request, Child $child)
    {
        Gate::authorize('update', $child); // Garante que o usuário logado é dono da criança

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points' => 'required|integer|min:1',
            'type' => 'required|in:single,recurring',
        ]);

        $task = $child->tasks()->create($validatedData);

        return response()->json($task, 201);
    }

    public function complete(Request $request, Child $child, Task $task)
    {
        Gate::authorize('update', $child);

        DB::transaction(function () use ($child, $task) {
            // Adiciona pontos à criança
            $child->increment('points', $task->points);

            // Cria um registro no histórico
            $child->taskHistory()->create([
                'task_id' => $task->id,
                'task_name' => $task->name,
                'points' => $task->points,
                'date_completed' => now(),
            ]);

            // Se a tarefa for do tipo 'única', remove-a
            if ($task->type === 'single') {
                $task->delete();
            }
        });

        return response()->json($child->fresh(['tasks', 'taskHistory']));
    }
}