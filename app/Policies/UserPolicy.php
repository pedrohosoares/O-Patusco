<?php

namespace App\Policies;

use App\Models\Users\Rule;
use App\Models\Users\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']));
    }
    

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']) || $user->rule->name_type == Rule::USER_TYPES['medico']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']) || $user->rule->name_type == Rule::USER_TYPES['cliente']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']) || $user->rule->name_type == Rule::USER_TYPES['medico']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }
}
