<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $table = 'guardians';

    protected $fillable = [
        'user_id',
        'email',
        'invited_user_id',
        'status',
    ];

    // Relacionamento com o usuário convidado
    public function invitedUser()
    {
        return $this->belongsTo(User::class, 'invited_user_id');
    }

    // Relacionamento com o usuário principal (conta/família)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
