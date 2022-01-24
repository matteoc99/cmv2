<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class Chat extends Component
{

    public $chat;

    public function render(Request $request)
    {
        $chat= \App\Models\Chat::where("ticket_id","=",$request->route('ticket'))->get()->first();
        return view('livewire.chat',["chat"=>$chat]);
    }
}
