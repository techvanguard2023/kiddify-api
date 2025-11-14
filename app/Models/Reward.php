<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'child_id',
        'name',
        'description',
        'points_required',
    ];

    /**
     * Get the child that owns the reward.
     * Uma recompensa pertence a uma criança.
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}