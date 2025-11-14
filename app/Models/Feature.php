<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    protected $table = 'features';

    public function featurePlans()
    {
        return $this->hasMany(FeaturePlan::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'feature_plans');
    }
}
