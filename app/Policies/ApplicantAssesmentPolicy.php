<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApplicantAssesment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantAssesmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the applicantAssesment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantAssesment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantAssesment  $model
     * @return mixed
     */
    public function view(User $user, ApplicantAssesment $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantAssesment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantAssesment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantAssesment  $model
     * @return mixed
     */
    public function update(User $user, ApplicantAssesment $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantAssesment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantAssesment  $model
     * @return mixed
     */
    public function delete(User $user, ApplicantAssesment $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantAssesment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantAssesment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantAssesment  $model
     * @return mixed
     */
    public function restore(User $user, ApplicantAssesment $model)
    {
        return false;
    }

    /**
     * Determine whether the applicantAssesment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantAssesment  $model
     * @return mixed
     */
    public function forceDelete(User $user, ApplicantAssesment $model)
    {
        return false;
    }
}
