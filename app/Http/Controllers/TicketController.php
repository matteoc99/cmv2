<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\Urgency;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\TicketCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function show(Ticket $ticket)
    {

        if (Auth::user()->cannot("view", $ticket))
            return response("401", 401);
        return view("ticket", ["ticket" => $ticket]);
    }

    public function showBytoken(Request $request)
    {
        $ticket = Ticket::where("token", "=", $request->route("token"))->get()->first();
        if (is_null($ticket))
            return response("", 404);

        if (!is_null(Auth::user()) && Auth::user()->isCraftsman()) {
            $ticket->craftsman_id = Auth::user()->id;
            $ticket->status_id = 2;
            $ticket->save();
            return redirect()->back();
        }
        return view("ticket", ["ticket" => $ticket]);
    }

    public function generateTicketToken(Ticket $ticket)
    {
        if (Auth::user()->cannot("createToken", $ticket))
            return response("401", 401);
        $ticket->token = str_random(60);
        $ticket->save();
        return redirect(route("ticket", $ticket->id));
    }

    public function showCreate(Request $request)
    {
        if (Auth::user()->cannot("create", Ticket::class))
            return response("401", 401);
        return view("createTicket", [
            "urgencies" => Urgency::all(),
            "tags" => Tag::all(),
        ]);
    }

    public function create(Request $request)
    {
        if (Auth::user()->cannot("create", Ticket::class))
            return response("401", 401);
        $request->validate([
            "title" => "required",
            'desc' => "required",
        ]);
        $ticket = new Ticket();
        $ticket->urgency_id = $request->get("urgency");
        $ticket->tag_id = $request->get("tag");
        $ticket->status_id = 1;
        $ticket->condominium_id = $request->get("condominium");
        $ticket->title = $request->get("title");
        $ticket->desc = $request->get("desc");
        if (Auth::user()->hasFamily()) {
            $ticket->family_id = Auth::user()->family_id;
        }
        $ticket->save();

        if (!Auth::user()->isAdmin()) {
            $admin = User::where("id", "=", $ticket->condominium()->admin_id)->get()->first();
            if ($admin->setting()->recive_ticket_created_notification) {
                $admin->notify(
                    new TicketCreatedNotification($ticket->family(), $ticket, $ticket->condominium())
                );
            }
        }
        $families = $ticket->condominium()->families();
        foreach ($families as $fam){
            $user =$fam->user();
            if ($user->id !=Auth::user()->id && $user->setting()->recive_ticket_created_notification) {
                $user->notify(
                    new TicketCreatedNotification($ticket->family(), $ticket, $ticket->condominium())
                );
            }
        }

        return redirect(route("condominium", $request->get("condominium")));
    }

    public function addToCraftsman(Request $request)
    {
        $token = $request->get("link");
        return redirect($token);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            "title" => "required",
            'desc' => "required",
        ]);
        $ticket->title = $request->get("title");
        $ticket->desc = $request->get("desc");
        if (!is_null($request->get("status")))
            $ticket->status_id = $request->get("status");
        $ticket->save();
        return redirect(route("ticket", $ticket->id))->with('success', "saved");

    }
}
