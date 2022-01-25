<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat_id = (int)$request->route('chat');

        $message = new Message();
        $message->sender_id = Auth::user()->id;
        $message->chat_id =$chat_id;
        $message->message =$request->get("message");
        $message->save();
        return redirect()->back();
    }
}
