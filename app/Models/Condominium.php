<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Condominium extends Model
{
    use HasFactory;

    public function Admin(){
        return $this->belongsTo('App\Models\User',"admin_id","id")->get()->first();
    }
    public function families()
    {
        return $this->hasMany(Family::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function hasOpenTickets(){
        return !is_null($this->tickets()->where("status_id","<",4)->get()->first());
    }
    public function openTickets(){
        return $this->tickets()->where("status_id","<",4)->get();
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

    public function getUnreadTicketsAttribute(){
        return count($this->unreadTickets());
    }

    public function totalFileSizeOfDocuments(){
        $docs = Document::where("condominium_id","=",$this->id)->get();
        $fileSize=0;
        foreach ($docs as $doc){
            $fileSize+=$doc->size;
        }
        return $fileSize;
    }
}
