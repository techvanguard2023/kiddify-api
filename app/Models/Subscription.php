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
}
