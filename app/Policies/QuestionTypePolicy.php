<?php

namespace App\Policies;

use App\Models\User;
use App\Models\QuestionType;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the questionType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the questionType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuestionType  $model
     * @return mixed
     */
    public function view(User $user, QuestionType $model)
    {
        return true;
    }

    /**
     * Determine whether the questionType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the questionType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuestionType  $model
     * @return mixed
     */
    public function update(User $user, QuestionType $model)
    {
        return true;
    }

    /**
     * Determine whether the questionType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuestionType  $model
     * @return mixed
     */
    public function delete(User $user, QuestionType $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuestionType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the questionType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuestionType  $model
     * @return mixed
     */
    public function restore(User $user, QuestionType $model)
    {
        return false;
    }

    /**
     * Determine whether the questionType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuestionType  $model
     * @return mixed
     */
    public function forceDelete(User $user, QuestionType $model)
    {
        return false;
    }
}
