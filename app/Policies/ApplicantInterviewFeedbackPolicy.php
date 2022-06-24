<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApplicantInterviewFeedback;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantInterviewFeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the applicantInterviewFeedback can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterviewFeedback can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterviewFeedback  $model
     * @return mixed
     */
    public function view(User $user, ApplicantInterviewFeedback $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterviewFeedback can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterviewFeedback can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterviewFeedback  $model
     * @return mixed
     */
    public function update(User $user, ApplicantInterviewFeedback $model)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterviewFeedback can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterviewFeedback  $model
     * @return mixed
     */
    public function delete(User $user, ApplicantInterviewFeedback $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterviewFeedback  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the applicantInterviewFeedback can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterviewFeedback  $model
     * @return mixed
     */
    public function restore(User $user, ApplicantInterviewFeedback $model)
    {
        return false;
    }

    /**
     * Determine whether the applicantInterviewFeedback can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApplicantInterviewFeedback  $model
     * @return mixed
     */
    public function forceDelete(User $user, ApplicantInterviewFeedback $model)
    {
        return false;
    }
}
