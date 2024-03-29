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
        return $this->belongsTo(Status::class);
    }

    public function contractType()
    {
        $contracttype=$this->belongsTo(ContractType::class);
        if(is_null($contracttype)){
            $this->contract_type_id=1;
            $this->save();
            return $this->contractType();
        }

        return $contracttype;
    }
    public function estimateByUserId($userId){
        return $this->estimates()->where("user_id","=",$userId)->get()->first();
    }
    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }
    public function hasApprovedEstimate()
    {
        return !is_null($this->approvedEstimate());
    }

    public function approvedEstimate()
    {
        return $this->estimates()->where("approved","=",true)->get()->first();
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class)->get()->first();
    }

    public function hasCraftsman()
    {
        return !is_null($this->craftsman_id);
    }

    public function craftsman()
    {
        return $this->belongsTo('App\Models\User', "craftsman_id", "id")->get()->first();
    }

    public function HasFamily()
    {
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
        if (is_null($this->chat_id)) {
            $chat = new Chat();
            $chat->ticket_id = $this->id;
            $chat->save();
            $this->chat_id = $chat->id;
            $this->save();
        }
        return $this->hasOne(Chat::class)->get()->first();
    }

    public function isNew()
    {
        return is_null(Auth::user()->seenTickets()->where("ticket_id", "=", $this->id)->get()->first());
    }

    public function price()
    {
        return !is_null($this->contractType()->get()->first())&&$this->contractType()->get()->first()->id === 2 ? $this->price : null;
    }

    public function addCraftsman($craftsman)
    {
        if (!$this->hasCraftsman()) {
            $this->craftsman_id = $craftsman->id;
            $this->status_id = 2;
            $this->save();
        }
    }

    public function unreadChatMessages(){
        $messages = $this->chat()->messages()->get();
        $userMessages = Auth::user()->seenMessages()->get();

        $unread = collect([]);
        foreach ($messages as $message)
        {
            if(count($userMessages->where("pivot.message_id","=",$message->id))==0){
                $unread = $unread->merge([$message]);
            }
        }
        return $unread;
    }


}
