<?php

namespace App\Policies;

use App\Models\Services\Schedule;
use App\Models\Users\Rule;
use App\Models\Users\User;
use Illuminate\Auth\Access\Response;

class SchedulePolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']) || $user->rule->name_type == Rule::USER_TYPES['medico']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']) || $user->rule->name_type == Rule::USER_TYPES['medico']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return (($user->rule->name_type == Rule::USER_TYPES['recepcionista']) || $user->rule->name_type == Rule::USER_TYPES['medico']);
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

    public function detachDoctor(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }

    public function attachDoctor(User $user): bool
    {
        return $user->rule->name_type == Rule::USER_TYPES['recepcionista'];
    }
}
