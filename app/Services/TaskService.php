<?php

namespace App\Services;

use App\Enums\TaskType;
use App\Models\Child;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /**
     * Mark a task as complete for a child, awarding points and logging history.
     */
    public function completeTask(Child $child, Task $task): Child
    {
        return DB::transaction(function () use ($child, $task) {
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
            if ($task->type === TaskType::Single) {
                $task->delete();
            }

            return $child->fresh(['tasks', 'taskHistory']);
        });
    }
}
