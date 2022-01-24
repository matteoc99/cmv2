<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
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
        $message = Message::create([
            'sender_id'   => Auth::user()->id,
            'chat_id'   => $request->input('chat_id'),
            'message'     => $request->input('message'),
        ]);

        return $message->fresh();
    }
}
