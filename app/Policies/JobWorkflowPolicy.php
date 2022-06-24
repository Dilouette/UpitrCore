<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobWorkflow;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobWorkflowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobWorkflow can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflow can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflow  $model
     * @return mixed
     */
    public function view(User $user, JobWorkflow $model)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflow can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflow can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflow  $model
     * @return mixed
     */
    public function update(User $user, JobWorkflow $model)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflow can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflow  $model
     * @return mixed
     */
    public function delete(User $user, JobWorkflow $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflow  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflow can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflow  $model
     * @return mixed
     */
    public function restore(User $user, JobWorkflow $model)
    {
        return false;
    }

    /**
     * Determine whether the jobWorkflow can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflow  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobWorkflow $model)
    {
        return false;
    }
}
