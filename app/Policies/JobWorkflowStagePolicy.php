<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobWorkflowStage;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobWorkflowStagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobWorkflowStage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflowStage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflowStage  $model
     * @return mixed
     */
    public function view(User $user, JobWorkflowStage $model)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflowStage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflowStage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflowStage  $model
     * @return mixed
     */
    public function update(User $user, JobWorkflowStage $model)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflowStage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflowStage  $model
     * @return mixed
     */
    public function delete(User $user, JobWorkflowStage $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflowStage  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobWorkflowStage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflowStage  $model
     * @return mixed
     */
    public function restore(User $user, JobWorkflowStage $model)
    {
        return false;
    }

    /**
     * Determine whether the jobWorkflowStage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobWorkflowStage  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobWorkflowStage $model)
    {
        return false;
    }
}
