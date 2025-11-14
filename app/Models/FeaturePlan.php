<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturePlan extends Model
{
    //
    protected $fillable = [
        'feature_id',
        'plan_id',
    ];

    protected $table = 'feature_plans';

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
