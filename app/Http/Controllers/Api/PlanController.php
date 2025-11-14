<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Feature;
use App\Http\Resources\PlanResource;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::with('features')->get();
        $features = Feature::all();


        return PlanResource::collection($plans)->additional([
            'features' => $features->pluck('name')->toArray(),
        ]);
    }
}
