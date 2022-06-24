<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EducationLevel;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the educationLevel can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the educationLevel can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EducationLevel  $model
     * @return mixed
     */
    public function view(User $user, EducationLevel $model)
    {
        return true;
    }

    /**
     * Determine whether the educationLevel can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the educationLevel can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EducationLevel  $model
     * @return mixed
     */
    public function update(User $user, EducationLevel $model)
    {
        return true;
    }

    /**
     * Determine whether the educationLevel can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EducationLevel  $model
     * @return mixed
     */
    public function delete(User $user, EducationLevel $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EducationLevel  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the educationLevel can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EducationLevel  $model
     * @return mixed
     */
    public function restore(User $user, EducationLevel $model)
    {
        return false;
    }

    /**
     * Determine whether the educationLevel can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EducationLevel  $model
     * @return mixed
     */
    public function forceDelete(User $user, EducationLevel $model)
    {
        return false;
    }
}
