<?php
namespace App\Policies;

use App\Models\Child;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Child $child)
    {
        return $user->id === $child->user_id;
    }
}