<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the note can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the note can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Note  $model
     * @return mixed
     */
    public function view(User $user, Note $model)
    {
        return true;
    }

    /**
     * Determine whether the note can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the note can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Note  $model
     * @return mixed
     */
    public function update(User $user, Note $model)
    {
        return true;
    }

    /**
     * Determine whether the note can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Note  $model
     * @return mixed
     */
    public function delete(User $user, Note $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Note  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the note can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Note  $model
     * @return mixed
     */
    public function restore(User $user, Note $model)
    {
        return false;
    }

    /**
     * Determine whether the note can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Note  $model
     * @return mixed
     */
    public function forceDelete(User $user, Note $model)
    {
        return false;
    }
}
