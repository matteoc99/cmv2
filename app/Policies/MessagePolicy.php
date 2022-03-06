<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function send(User $user,Message $message){
        $ticket= $message->chat()->ticket();
        $canCraftsman = $user->isCraftsman()&&$ticket->craftsman_id==$user->id();
        $canUser=  $user->isUser()&&$ticket->condominium()->id==$user->family()->condominium()->id();
        $canAdmin= $user->isAdmin();
        if($canAdmin){
            $canAdmin=false;
            foreach ($user->administrates()->get() as $con){
                if($con->id == $ticket->condominium()->id)
                    $canAdmin=true;
            }
        }

               return $canUser||$canCraftsman||$canAdmin
                   ? Response::allow()
                   : Response::deny('You do allowed to send messages');
    }
}
