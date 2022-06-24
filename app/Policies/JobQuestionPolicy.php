<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobQuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobQuestion can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestion can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestion  $model
     * @return mixed
     */
    public function view(User $user, JobQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestion can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestion can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestion  $model
     * @return mixed
     */
    public function update(User $user, JobQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestion can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestion  $model
     * @return mixed
     */
    public function delete(User $user, JobQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestion  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestion can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestion  $model
     * @return mixed
     */
    public function restore(User $user, JobQuestion $model)
    {
        return false;
    }

    /**
     * Determine whether the jobQuestion can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestion  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobQuestion $model)
    {
        return false;
    }
}
