<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AssesmentResponse;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssesmentResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the assesmentResponse can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesmentResponse can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentResponse  $model
     * @return mixed
     */
    public function view(User $user, AssesmentResponse $model)
    {
        return true;
    }

    /**
     * Determine whether the assesmentResponse can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesmentResponse can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentResponse  $model
     * @return mixed
     */
    public function update(User $user, AssesmentResponse $model)
    {
        return true;
    }

    /**
     * Determine whether the assesmentResponse can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentResponse  $model
     * @return mixed
     */
    public function delete(User $user, AssesmentResponse $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentResponse  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesmentResponse can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentResponse  $model
     * @return mixed
     */
    public function restore(User $user, AssesmentResponse $model)
    {
        return false;
    }

    /**
     * Determine whether the assesmentResponse can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentResponse  $model
     * @return mixed
     */
    public function forceDelete(User $user, AssesmentResponse $model)
    {
        return false;
    }
}
