<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Interview;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the interview can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the interview can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Interview  $model
     * @return mixed
     */
    public function view(User $user, Interview $model)
    {
        return true;
    }

    /**
     * Determine whether the interview can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the interview can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Interview  $model
     * @return mixed
     */
    public function update(User $user, Interview $model)
    {
        return true;
    }

    /**
     * Determine whether the interview can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Interview  $model
     * @return mixed
     */
    public function delete(User $user, Interview $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Interview  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the interview can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Interview  $model
     * @return mixed
     */
    public function restore(User $user, Interview $model)
    {
        return false;
    }

    /**
     * Determine whether the interview can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Interview  $model
     * @return mixed
     */
    public function forceDelete(User $user, Interview $model)
    {
        return false;
    }
}
