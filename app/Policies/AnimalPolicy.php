<?php

namespace App\Policies;

use App\Models\Animals\Animal;
use App\Models\Users\Rule;
use App\Models\Users\User;

class AnimalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Animal $animal): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }
}
