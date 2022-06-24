<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApplicantInterview;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantInterviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the applicantInterview can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterview can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterview  $model
     * @return mixed
     */
    public function view(User $user, ApplicantInterview $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterview can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterview can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterview  $model
     * @return mixed
     */
    public function update(User $user, ApplicantInterview $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterview can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterview  $model
     * @return mixed
     */
    public function delete(User $user, ApplicantInterview $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterview  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterview can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterview  $model
     * @return mixed
     */
    public function restore(User $user, ApplicantInterview $model)
    {
        return false;
    }

    /**
     * Determine whether the applicantInterview can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterview  $model
     * @return mixed
     */
    public function forceDelete(User $user, ApplicantInterview $model)
    {
        return false;
    }
}
