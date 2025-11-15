<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'child_id',
        'name',
        'description',
        'points',
        'type',
    ];

    /**
     * Get the child that owns the task.
     * Uma tarefa pertence a uma criança.
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}