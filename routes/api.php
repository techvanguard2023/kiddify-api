<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\RewardController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\GuardianController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StripeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    Route::get('status', function () {
        return response()->json(['status' => 'API V1 is alive!'], 200);
    });

    // Rotas de Autenticação (Públicas)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rotas para Planos (Plans)
    Route::apiResource('plans', PlanController::class)->only(['index']);

    Route::post('/stripe/webhook', [StripeController::class, 'webhook']);

    // Rotas Protegidas (Requerem autenticação via Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Rotas para Crianças (Children)
        Route::apiResource('children', ChildController::class)->only(['index', 'store']);

        Route::delete('/children/{child}/tasks/{task}', [TaskController::class, 'destroy']);
        Route::delete('/children/{child}/rewards/{reward}', [RewardController::class, 'destroy']);

        // Rotas aninhadas para Tarefas (Tasks) de uma Criança
        Route::prefix('children/{child}')->scopeBindings()->group(function() {
            // Criar uma tarefa para uma criança
            Route::post('tasks', [TaskController::class, 'store']);
            // Marcar uma tarefa como concluída
            Route::post('tasks/{task}/complete', [TaskController::class, 'complete']);
            

            // Criar uma recompensa para uma criança
            Route::post('rewards', [RewardController::class, 'store']);
            // Resgatar uma recompensa
            Route::post('rewards/{reward}/claim', [RewardController::class, 'claim']);
            
        });

        // Rotas para Gerenciar Responsáveis
        Route::get('/guardians', [GuardianController::class, 'index']);
        Route::post('/guardians/invite', [GuardianController::class, 'invite']);
        Route::delete('/guardians/{guardian}', [GuardianController::class, 'destroy']);

        // Rota para atualizar o valor do ponto do usuário
        Route::post('/user/point-value', [UserController::class, 'updatePointValue']);
    });

});