<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobQuestionOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobQuestionOptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobQuestionOption can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestionOption can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestionOption  $model
     * @return mixed
     */
    public function view(User $user, JobQuestionOption $model)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestionOption can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestionOption can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestionOption  $model
     * @return mixed
     */
    public function update(User $user, JobQuestionOption $model)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestionOption can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestionOption  $model
     * @return mixed
     */
    public function delete(User $user, JobQuestionOption $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestionOption  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobQuestionOption can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestionOption  $model
     * @return mixed
     */
    public function restore(User $user, JobQuestionOption $model)
    {
        return false;
    }

    /**
     * Determine whether the jobQuestionOption can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobQuestionOption  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobQuestionOption $model)
    {
        return false;
    }
}
