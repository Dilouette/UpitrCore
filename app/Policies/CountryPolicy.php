<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the country can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the country can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Country  $model
     * @return mixed
     */
    public function view(User $user, Country $model)
    {
        return true;
    }

    /**
     * Determine whether the country can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the country can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Country  $model
     * @return mixed
     */
    public function update(User $user, Country $model)
    {
        return true;
    }

    /**
     * Determine whether the country can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Country  $model
     * @return mixed
     */
    public function delete(User $user, Country $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Country  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the country can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Country  $model
     * @return mixed
     */
    public function restore(User $user, Country $model)
    {
        return false;
    }

    /**
     * Determine whether the country can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Country  $model
     * @return mixed
     */
    public function forceDelete(User $user, Country $model)
    {
        return false;
    }
}
