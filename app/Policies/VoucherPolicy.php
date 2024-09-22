<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vouchers;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoucherPolicy
{
    use HandlesAuthorization;
    private const ROLE_NAME =
        [
            'admin'
        ];

    public function viewAny(User $user): bool
    {
        return $user->role->role_admin === self::ROLE_NAME;
    }

    public function view(User $user, Vouchers $vouchers): bool
    {
        return $user->role->role_admin ===  self::ROLE_NAME;
    }

    public function create(User $user): bool
    {
        return $user->role->role_admin === self::ROLE_NAME;

    }

    public function update(User $user, Vouchers $vouchers): bool
    {
        return $user->role->role_admin === self::ROLE_NAME;

    }

    public function delete(User $user, Vouchers $vouchers): bool
    {
        return $user->role->role_admin ===  self::ROLE_NAME || $user->user_id === $vouchers->user_id;
    }

    public function restore(User $user, Vouchers $vouchers): bool
    {
    }

    public function forceDelete(User $user, Vouchers $vouchers): bool
    {
    }
}
