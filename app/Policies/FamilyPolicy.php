<?php

namespace App\Policies;

use App\Models\Family;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FamilyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Family $family)
    {
        return $user->hasFamily()&&$user->family()->id===$family->id ||
            $user->administrates()->where("id","=",$family->condominium_id)->get()==1
            ? Response::allow()
            : Response::deny('You are not allowed to view this Condominium');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You do not an Administrator');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Family $family)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Family $family)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Family $family)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Family $family)
    {
        //
    }
}
