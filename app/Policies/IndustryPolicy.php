<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Industry;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndustryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the industry can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the industry can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function view(User $user, Industry $model)
    {
        return true;
    }

    /**
     * Determine whether the industry can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the industry can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function update(User $user, Industry $model)
    {
        return true;
    }

    /**
     * Determine whether the industry can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function delete(User $user, Industry $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the industry can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function restore(User $user, Industry $model)
    {
        return false;
    }

    /**
     * Determine whether the industry can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function forceDelete(User $user, Industry $model)
    {
        return false;
    }
}
