<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Condominium extends Model
{
    use HasFactory;
    public function Admin(){
        return $this->belongsTo('App\Models\User',"admin_id","id");
    }
    public function families()
    {
        return $this->hasMany(Family::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function unreadTickets(){
        $tickets = $this->tickets()->get();
        $userTickets = Auth::user()->seenTickets()->get();

        $unread = collect([]);
        foreach ($tickets as $ticket)
        {
            if(count($userTickets->where("pivot.ticket_id","=",$ticket->id))==0){
                $unread = $unread->merge([$ticket]);
            }
        }
        return $unread;
    }

}
