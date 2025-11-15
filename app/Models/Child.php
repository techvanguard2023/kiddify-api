<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'sex',
        'avatar_url',
        'points',
    ];

    /**
     * Get the user (parent) that owns the child.
     * Uma criança pertence a um usuário (pai).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tasks for the child.
     * Uma criança pode ter várias tarefas.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the rewards for the child.
     * Uma criança pode ter várias recompensas.
     */
    public function rewards(): HasMany
    {
        return $this->hasMany(Reward::class);
    }

    /**
     * Get the task history for the child.
     * Uma criança tem um histórico de várias tarefas concluídas.
     */
    public function taskHistory(): HasMany
    {
        return $this->hasMany(TaskLog::class);
    }
}