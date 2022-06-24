<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AssesmentQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssesmentQuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the assesmentQuestion can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesmentQuestion can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentQuestion  $model
     * @return mixed
     */
    public function view(User $user, AssesmentQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the assesmentQuestion can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesmentQuestion can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentQuestion  $model
     * @return mixed
     */
    public function update(User $user, AssesmentQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the assesmentQuestion can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentQuestion  $model
     * @return mixed
     */
    public function delete(User $user, AssesmentQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentQuestion  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the assesmentQuestion can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentQuestion  $model
     * @return mixed
     */
    public function restore(User $user, AssesmentQuestion $model)
    {
        return false;
    }

    /**
     * Determine whether the assesmentQuestion can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AssesmentQuestion  $model
     * @return mixed
     */
    public function forceDelete(User $user, AssesmentQuestion $model)
    {
        return false;
    }
}
