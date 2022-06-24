<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InteviewQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class InteviewQuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the inteviewQuestion can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the inteviewQuestion can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InteviewQuestion  $model
     * @return mixed
     */
    public function view(User $user, InteviewQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the inteviewQuestion can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the inteviewQuestion can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InteviewQuestion  $model
     * @return mixed
     */
    public function update(User $user, InteviewQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the inteviewQuestion can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InteviewQuestion  $model
     * @return mixed
     */
    public function delete(User $user, InteviewQuestion $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InteviewQuestion  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the inteviewQuestion can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InteviewQuestion  $model
     * @return mixed
     */
    public function restore(User $user, InteviewQuestion $model)
    {
        return false;
    }

    /**
     * Determine whether the inteviewQuestion can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InteviewQuestion  $model
     * @return mixed
     */
    public function forceDelete(User $user, InteviewQuestion $model)
    {
        return false;
    }
}
