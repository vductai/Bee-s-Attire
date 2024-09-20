<?php

namespace App\Policies;

use App\Models\Size;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SizePolicy
{
    use HandlesAuthorization;

    private const ROLE_NAME = ['admin'];

    public function viewAny(User $user): bool
    {
        return $user->role->role_name === self::ROLE_NAME;
    }

    public function view(User $user, Size $size): bool
    {
        return $user->role->role_name === self::ROLE_NAME;
    }

    public function create(User $user): bool
    {
        return $user->role->role_name === self::ROLE_NAME;

    }

    public function update(User $user, Size $size): bool
    {
        return $user->role->role_name === self::ROLE_NAME;

    }

    public function delete(User $user, Size $size): bool
    {
        return $user->role->role_name === self::ROLE_NAME;

    }

    public function restore(User $user, Size $size): bool
    {
    }

    public function forceDelete(User $user, Size $size): bool
    {
    }
}
