<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;
    private const ROLE_USER = ['admin'];

    public function manageClient(User $user, User $model): bool
    {
        return $user->role->role_name === self::ROLE_USER || $user->user_id === $model->user_id;
    }

}
