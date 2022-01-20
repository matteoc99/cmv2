<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\Urgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function showCreate(Request $request)
    {
        if(Auth::user()->cannot("create",Ticket::class))
            return response("401",401);
        return view("createTicket",[
            "urgencies"=>Urgency::all(),
            "tags"=>Tag::all(),
        ]);
    }

    public function create(Request $request)
    {
        if(Auth::user()->cannot("create",Ticket::class))
            return response("401",401);
        $request->validate([
            "title" => "required",
            'desc' => "required",
        ]);
        $ticket = new Ticket();
        $ticket->urgency_id = $request->get("urgency");
        $ticket->tag_id = $request->get("tag");
        $ticket->status_id =1;
        $ticket->condominium_id =$request->get("condominium");
        $ticket->title =$request->get("title");
        $ticket->desc =$request->get("desc");
        if(Auth::user()->hasFamily()){
            $ticket->family_id==Auth::user()->family_id;
        }
        $ticket->save();

        return redirect(route("condominium",$request->get("condominium")));

    }
}
