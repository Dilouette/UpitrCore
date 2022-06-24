<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InterviewSection;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewSectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the interviewSection can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the interviewSection can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InterviewSection  $model
     * @return mixed
     */
    public function view(User $user, InterviewSection $model)
    {
        return true;
    }

    /**
     * Determine whether the interviewSection can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the interviewSection can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InterviewSection  $model
     * @return mixed
     */
    public function update(User $user, InterviewSection $model)
    {
        return true;
    }

    /**
     * Determine whether the interviewSection can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InterviewSection  $model
     * @return mixed
     */
    public function delete(User $user, InterviewSection $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InterviewSection  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the interviewSection can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InterviewSection  $model
     * @return mixed
     */
    public function restore(User $user, InterviewSection $model)
    {
        return false;
    }

    /**
     * Determine whether the interviewSection can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InterviewSection  $model
     * @return mixed
     */
    public function forceDelete(User $user, InterviewSection $model)
    {
        return false;
    }
}
