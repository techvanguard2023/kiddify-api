<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;



class TaskLog extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'child_id',
        'task_id',
        'task_name',
        'points',
        'date_completed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_completed' => 'datetime',
    ];

    /**
     * Get the child associated with the task log.
     * Um registro de tarefa pertence a uma criança.
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * Get the original task associated with the log (can be null).
     * Um registro de tarefa pode pertencer a uma tarefa original (que pode ter sido deletada).
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}