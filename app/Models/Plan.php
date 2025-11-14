<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plans';

    protected $fillable = [
        'name',
        'description',
        'price',
        'period',
        'is_free',
        'popular',
        'stripe_price_id',
    ];


    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function featurePlans()
    {
        return $this->hasMany(FeaturePlan::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_plans');
    }
}
