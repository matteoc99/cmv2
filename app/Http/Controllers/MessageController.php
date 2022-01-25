<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        if ($request->hasFile("file")) {
            $uuid = Str::uuid()->toString();
            $ext = $request->file->extension();
            $fileName = $uuid . '.' . $ext;
            $request->file->move(public_path('uploads'), $fileName);
            $message->uuid = $uuid;
            $message->mime_type = $ext;;
        }

        $message->save();
        return redirect()->back();
    }
}
