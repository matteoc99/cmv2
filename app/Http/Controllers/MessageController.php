<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Picture;
use App\Services\DownsizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MessageController extends Controller
{



    public function store(Request $request)
    {

        $chat_id = (int)$request->route('chat');

        $message = new Message();
        $message->sender_id = Auth::user()->id;
        $message->chat_id = $chat_id;
        $message->message = $request->get("message");

        if ($request->hasFile("file")) {
            $uuid = Str::uuid()->toString();
            $ext = $request->file->extension();
            $fileName = $uuid . '.' . $ext;
            $request->file->move(public_path('uploads'), $fileName);
            if (in_array($ext, ["png", "jpeg", "jpg"]))
                DownsizerService::scaleDown(public_path('uploads/' . $fileName), $ext, 0.001);

            $message->uuid = $uuid;
            $message->mime_type = $ext;
        }

        if(Auth::user()->cannot("send",$message))
            return response("401",401);

        $message->save();
        return redirect()->back();
    }
}
