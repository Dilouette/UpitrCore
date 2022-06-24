<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobSetting can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobSetting can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobSetting  $model
     * @return mixed
     */
    public function view(User $user, JobSetting $model)
    {
        return true;
    }

    /**
     * Determine whether the jobSetting can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobSetting can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobSetting  $model
     * @return mixed
     */
    public function update(User $user, JobSetting $model)
    {
        return true;
    }

    /**
     * Determine whether the jobSetting can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobSetting  $model
     * @return mixed
     */
    public function delete(User $user, JobSetting $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobSetting  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobSetting can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobSetting  $model
     * @return mixed
     */
    public function restore(User $user, JobSetting $model)
    {
        return false;
    }

    /**
     * Determine whether the jobSetting can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobSetting  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobSetting $model)
    {
        return false;
    }
}
