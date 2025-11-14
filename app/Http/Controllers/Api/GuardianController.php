<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guardian; // Certifique-se de que o Model 'Guardian' existe
use App\Models\User;    // Seu model de User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Mail\GuardianInvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GuardianController extends Controller
{
    /**
     * Lista todos os responsáveis associados à conta do usuário autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Pega todos os guardiões convidados pelo usuário
        $invitedGuardians = Guardian::where('user_id', $user->id)->get();

        // Adiciona o próprio usuário (dono da conta) à lista como um responsável ativo
        $ownerGuardian = [
            'id' => $user->id, // Usamos o user->id para o frontend poder desabilitar a remoção
            'name' => $user->name,
            'email' => $user->email,
            'status' => 'active',
        ];

        // Combina o dono da conta com os convidados
        $allGuardians = $invitedGuardians->map(function ($guardian) {
             // Tenta encontrar um usuário registrado com o e-mail do convidado
            $invitedUser = User::where('email', $guardian->email)->first();
            return [
                'id' => $guardian->id,
                'name' => $invitedUser ? $invitedUser->name : 'Convidado', // Mostra o nome se já for usuário
                'email' => $guardian->email,
                'status' => $guardian->status,
            ];
        });

        // Adiciona o dono no início da coleção
        $allGuardians->prepend($ownerGuardian);

        return response()->json($allGuardians);
    }

    /**
     * Cria e envia um convite para um novo responsável.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function invite(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                // Garante que o e-mail não seja o do próprio usuário
                Rule::notIn([$user->email]),
                // Garante que o e-mail não tenha sido convidado para esta conta ainda
                Rule::unique('guardians')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                }),
            ],
        ]);

        $guardian = Guardian::create([
            'user_id' => $user->id,
            'email' => $validated['email'],
            'status' => 'pending',
            'token' => Str::random(32), // O status inicial é sempre pendente
        ]);


        $acceptUrl = url('/invitation/' . $guardian->token); 

        Mail::to($validated['email'])->send(new GuardianInvitationMail($user, $acceptUrl));

        // TODO: Aqui você pode adicionar a lógica para enviar um e-mail de convite
        // Mail::to($validated['email'])->send(new GuardianInvitation($guardian));

        // Formata a resposta para corresponder ao que o frontend espera
        $invitedUser = User::where('email', $guardian->email)->first();
        $responseGuardian = [
            'id' => $guardian->id,
            'name' => $invitedUser ? $invitedUser->name : 'Convidado',
            'email' => $guardian->email,
            'status' => $guardian->status,
        ];

        return response()->json($responseGuardian, 201); // 201 Created
    }

    /**
     * Remove um responsável da conta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guardian  $guardian
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Guardian $guardian)
    {
        // Política de Autorização: Garante que o usuário autenticado é o dono da conta
        // à qual o guardião pertence.
        if ($guardian->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $guardian->delete();

        return response()->json(['message' => 'Guardian removed successfully']);
    }
}