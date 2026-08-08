<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permit;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can approve the permit.
     */
    public function approve(User $user, Permit $permit): bool
    {
        // Super admin can always approve
        if ($user->hasRole('super-admin')) {
            return true;
        }

        // Users with explicit permission can approve
        if ($user->can('permit.approve')) {
            return true;
        }

        // Additional business logic: department, officer assignment, etc.
        return false;
    }
}
