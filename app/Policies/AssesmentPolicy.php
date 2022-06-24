<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Assesment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssesmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the assesment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assesment  $model
     * @return mixed
     */
    public function view(User $user, Assesment $model)
    {
        return true;
    }

    /**
     * Determine whether the assesment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assesment  $model
     * @return mixed
     */
    public function update(User $user, Assesment $model)
    {
        return true;
    }

    /**
     * Determine whether the assesment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assesment  $model
     * @return mixed
     */
    public function delete(User $user, Assesment $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assesment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assesment  $model
     * @return mixed
     */
    public function restore(User $user, Assesment $model)
    {
        return false;
    }

    /**
     * Determine whether the assesment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assesment  $model
     * @return mixed
     */
    public function forceDelete(User $user, Assesment $model)
    {
        return false;
    }
}
