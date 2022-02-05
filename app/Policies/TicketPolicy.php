<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TicketPolicy
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
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function chat(User $user, Ticket $ticket){
        $administrates = $user->administrates()->where("id","=",$ticket->condominium_id)->get();
        return (($user->hasFamily()&&$user->family_id==$ticket->family_id) ||
            ($user->hasFamily()&&$user->family()->condominium_id==$ticket->condominium_id) ||
            (!is_null($administrates->first()))||
            ($user->isCraftsman()&&$user->id ==$ticket->craftsman_id))
            ? Response::allow()
            : Response::deny();
    }
    public function view(User $user, Ticket $ticket)
    {
        $administrates = $user->administrates()->where("id","=",$ticket->condominium_id)->get();
        return (($user->hasFamily()&&$user->family_id==$ticket->family_id) ||
         ($user->hasFamily()&&$user->family()->condominium_id==$ticket->condominium_id) ||
        (!is_null($administrates->first()))||
            ($user->isCraftsman()&&$ticket->contract_type_id===3 &&$ticket->status_id<3 ))
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {

        return $user->isUser() || $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }
    public function approveEstimates(User $user,Ticket $ticket){
        $condominia =Auth::user()->administrates()->where("id","=",$ticket->condominium_id)->get();
        return Auth::user()->isAdmin()&&$ticket->contractType()->id===3
            ? Response::allow()
            : Response::deny();
    }
    public function createEstimate(User $user,Ticket $ticket){
        return Auth::user()->isCraftsman()&&$ticket->contractType()->id===3
            ? Response::allow()
            : Response::deny();
    }
    public function createToken(User $user,Ticket $ticket)
    {
        $condominia =Auth::user()->administrates()->where("id","=",$ticket->condominium_id)->get();
        return Auth::user()->isAdmin()&&is_countable($condominia)&&count($condominia)>=1&&is_null($ticket->craftsman_id)
            ? Response::allow()
            : Response::deny();
    }
    public function changeContractType(User $user,Ticket $ticket){
        return Auth::user()->isAdmin()
            ? Response::allow()
            : Response::deny();
    }
    public function addCraftsman(User $user,Ticket $ticket)
    {
        $condominia =Auth::user()->administrates()->where("id","=",$ticket->condominium_id)->get();
        return Auth::user()->isAdmin()&&is_countable($condominia)&&count($condominia)>=1
            ? Response::allow()
            : Response::deny();
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ticket $ticket)
    {
        $fam =$ticket->family();
        $con =$fam->condominium()->get();

        return ($user->isUser()&&$user->family_id==$fam->id) ||
        ($user->isAdmin()&&$con->admin_id == $user->id) ||
        ($user->isCraftsman()&&$con->craftsman_id == $user->id)
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }
}
