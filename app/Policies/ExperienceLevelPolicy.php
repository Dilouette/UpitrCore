<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ExperienceLevel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperienceLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the experienceLevel can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the experienceLevel can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ExperienceLevel  $model
     * @return mixed
     */
    public function view(User $user, ExperienceLevel $model)
    {
        return true;
    }

    /**
     * Determine whether the experienceLevel can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the experienceLevel can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ExperienceLevel  $model
     * @return mixed
     */
    public function update(User $user, ExperienceLevel $model)
    {
        return true;
    }

    /**
     * Determine whether the experienceLevel can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ExperienceLevel  $model
     * @return mixed
     */
    public function delete(User $user, ExperienceLevel $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ExperienceLevel  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the experienceLevel can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ExperienceLevel  $model
     * @return mixed
     */
    public function restore(User $user, ExperienceLevel $model)
    {
        return false;
    }

    /**
     * Determine whether the experienceLevel can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ExperienceLevel  $model
     * @return mixed
     */
    public function forceDelete(User $user, ExperienceLevel $model)
    {
        return false;
    }
}
