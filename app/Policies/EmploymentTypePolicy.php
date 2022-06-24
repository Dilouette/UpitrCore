<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EmploymentType;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmploymentTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the employmentType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the employmentType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmploymentType  $model
     * @return mixed
     */
    public function view(User $user, EmploymentType $model)
    {
        return true;
    }

    /**
     * Determine whether the employmentType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the employmentType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmploymentType  $model
     * @return mixed
     */
    public function update(User $user, EmploymentType $model)
    {
        return true;
    }

    /**
     * Determine whether the employmentType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmploymentType  $model
     * @return mixed
     */
    public function delete(User $user, EmploymentType $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmploymentType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the employmentType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmploymentType  $model
     * @return mixed
     */
    public function restore(User $user, EmploymentType $model)
    {
        return false;
    }

    /**
     * Determine whether the employmentType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmploymentType  $model
     * @return mixed
     */
    public function forceDelete(User $user, EmploymentType $model)
    {
        return false;
    }
}
