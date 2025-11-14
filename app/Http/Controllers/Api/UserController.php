<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Atualiza o valor do ponto para o usuário autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePointValue(Request $request)
    {
        $validated = $request->validate([
            'point_value' => 'required|numeric|min:0',
        ]);

        $user = $request->user();
        
        $user->point_value = $validated['point_value'];
        $user->save();

        // Retorna o usuário atualizado, como o frontend espera
        return response()->json($user);
    }
}