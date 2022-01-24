<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    use HasFactory;

    public function urgency()
    {
        return $this->belongsTo(Urgency::class)->get()->first();
    }
    public function hasStatus()
    {
        return !is_null($this->status_id);
    }
    public function status()
    {
        return $this->belongsTo(Status::class)->get()->first();
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class)->get()->first();
    }
    public function HasCraftsman(){
        return !is_null($this->craftsman_id);
    }
    public function craftsman()
    {
        return $this->belongsTo('App\Models\User',"craftsman_id","id")->get()->first();
    }
    public function HasFamily(){
        return !is_null($this->family_id);
    }
    public function family()
    {
        return $this->belongsTo(Family::class)->get()->first();
    }
    public function condominium()
    {
        return $this->belongsTo(Condominium::class)->get()->first();
    }

    public function chat()
    {
        if(is_null($this->chat_id))
        {
            $chat = new Chat();
            $chat->ticket_id=$this->id;
            $chat->save();
            $this->chat_id = $chat->id;
            $this->save();
        }
        return $this->hasOne(Chat::class)->get()->first();
    }
    public function isNew()
    {
        return is_null(Auth::user()->seenTickets()->where("ticket_id","=",$this->id)->get()->first());
    }
}
