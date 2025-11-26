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
    public function store(\App\Http\Requests\StoreTaskRequest $request, Child $child)
    {
        Gate::authorize('update', $child); // Garante que o usuário logado é dono da criança

        $task = $child->tasks()->create($request->validated());

        return new \App\Http\Resources\TaskResource($task);
    }

    public function complete(Request $request, Child $child, Task $task, \App\Services\TaskService $taskService)
    {
        Gate::authorize('update', $child);

        $updatedChild = $taskService->completeTask($child, $task);

        return response()->json($updatedChild);
    }

    // Exemplo no TaskController.php
    public function destroy(Child $child, Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return response()->json(['message' => 'Tarefa apagada com sucesso.']);
    }
}