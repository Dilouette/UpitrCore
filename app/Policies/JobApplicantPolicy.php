<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobApplicant;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobApplicant can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobApplicant can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobApplicant  $model
     * @return mixed
     */
    public function view(User $user, JobApplicant $model)
    {
        return true;
    }

    /**
     * Determine whether the jobApplicant can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobApplicant can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobApplicant  $model
     * @return mixed
     */
    public function update(User $user, JobApplicant $model)
    {
        return true;
    }

    /**
     * Determine whether the jobApplicant can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobApplicant  $model
     * @return mixed
     */
    public function delete(User $user, JobApplicant $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobApplicant  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobApplicant can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobApplicant  $model
     * @return mixed
     */
    public function restore(User $user, JobApplicant $model)
    {
        return false;
    }

    /**
     * Determine whether the jobApplicant can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobApplicant  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobApplicant $model)
    {
        return false;
    }
}
