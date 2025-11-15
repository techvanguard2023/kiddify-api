<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $fillable = [
        'user_id',
        'plan_id',
        'stripe_subscription_id',
        'price',
        'start_date',
        'end_date',
        'status',
    ];

    protected $table = 'subscriptions';

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Escopo útil para pegar assinaturas ativas "hoje"
    public function scopeActive($query)
    {
        return $query
            ->where('status', 'active')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    // Atributo conveniente
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active'
            && $this->start_date->lte(now())
            && $this->end_date->gte(now());
    }
}
