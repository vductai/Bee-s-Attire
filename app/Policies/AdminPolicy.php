<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vouchers;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    private const ROLE_USER = ['admin'];

    public function manageAdmin(User $user): bool
    {
        return $user->role->role_name === self::ROLE_USER;
    }

}
