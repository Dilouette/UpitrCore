<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BenefitTemplate;
use Illuminate\Auth\Access\HandlesAuthorization;

class BenefitTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the benefitTemplate can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the benefitTemplate can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BenefitTemplate  $model
     * @return mixed
     */
    public function view(User $user, BenefitTemplate $model)
    {
        return true;
    }

    /**
     * Determine whether the benefitTemplate can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the benefitTemplate can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BenefitTemplate  $model
     * @return mixed
     */
    public function update(User $user, BenefitTemplate $model)
    {
        return true;
    }

    /**
     * Determine whether the benefitTemplate can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BenefitTemplate  $model
     * @return mixed
     */
    public function delete(User $user, BenefitTemplate $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BenefitTemplate  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the benefitTemplate can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BenefitTemplate  $model
     * @return mixed
     */
    public function restore(User $user, BenefitTemplate $model)
    {
        return false;
    }

    /**
     * Determine whether the benefitTemplate can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BenefitTemplate  $model
     * @return mixed
     */
    public function forceDelete(User $user, BenefitTemplate $model)
    {
        return false;
    }
}
