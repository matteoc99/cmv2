<?php

namespace App\Policies;

use App\Models\Condominium;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CondominiumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin()||$user->isUser()
            ? Response::allow()
            : Response::deny('You are not allowed to view this Condominium');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Condominium $condominium
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Condominium $condominium)
    {
        return count($user->administrates()->where("id","=",$condominium->id)->get())==1
            || ($user->hasFamily() && $user->family()->get()->condominium_id===$condominium->id)
            ? Response::allow()
            : Response::deny('You are not allowed to view this Condominium');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
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
     * @param \App\Models\User $user
     * @param \App\Models\Condominium $condominium
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Condominium $condominium)
    {
        return $condominium->Admin()->get()->id === $user->id
            ? Response::allow()
            : Response::deny('You do not an Administrator');;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Condominium $condominium
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Condominium $condominium)
    {
        return $condominium->Admin()->get()->id === $user->id
            ? Response::allow()
            : Response::deny('You do not an Administrator');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Condominium $condominium
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Condominium $condominium)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Condominium $condominium
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Condominium $condominium)
    {
        //
    }
}
