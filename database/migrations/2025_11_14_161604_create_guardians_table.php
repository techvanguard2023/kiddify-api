<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            
            // Chave estrangeira para a conta/família principal. 
            // Assumindo que a tabela principal de contas se chama 'users'.
            // Se for 'accounts' ou outro nome, ajuste o 'constrained()'.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // E-mail da pessoa que foi convidada
            $table->string('email');
            
            // ID do usuário convidado (pode ser nulo até ele se cadastrar/aceitar o convite)
            // Isso cria a ligação real com a tabela de usuários.
            $table->unsignedBigInteger('invited_user_id')->nullable();
            $table->foreign('invited_user_id')->references('id')->on('users')->onDelete('set null');

            // Status do convite: 'pending' ou 'active'
            $table->enum('status', ['pending', 'active'])->default('pending');
            
            $table->timestamps();

            // Garante que um e-mail só possa ser convidado uma vez por conta.
            $table->unique(['user_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};