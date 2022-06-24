<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApplicantResponse;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the applicantResponse can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantResponse can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantResponse  $model
     * @return mixed
     */
    public function view(User $user, ApplicantResponse $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantResponse can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantResponse can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantResponse  $model
     * @return mixed
     */
    public function update(User $user, ApplicantResponse $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantResponse can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantResponse  $model
     * @return mixed
     */
    public function delete(User $user, ApplicantResponse $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantResponse  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantResponse can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantResponse  $model
     * @return mixed
     */
    public function restore(User $user, ApplicantResponse $model)
    {
        return false;
    }

    /**
     * Determine whether the applicantResponse can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantResponse  $model
     * @return mixed
     */
    public function forceDelete(User $user, ApplicantResponse $model)
    {
        return false;
    }
}
