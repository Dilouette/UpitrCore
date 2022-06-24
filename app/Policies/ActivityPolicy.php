<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the activity can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the activity can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Activity  $model
     * @return mixed
     */
    public function view(User $user, Activity $model)
    {
        return true;
    }

    /**
     * Determine whether the activity can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the activity can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Activity  $model
     * @return mixed
     */
    public function update(User $user, Activity $model)
    {
        return true;
    }

    /**
     * Determine whether the activity can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Activity  $model
     * @return mixed
     */
    public function delete(User $user, Activity $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Activity  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the activity can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Activity  $model
     * @return mixed
     */
    public function restore(User $user, Activity $model)
    {
        return false;
    }

    /**
     * Determine whether the activity can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Activity  $model
     * @return mixed
     */
    public function forceDelete(User $user, Activity $model)
    {
        return false;
    }
}
