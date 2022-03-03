<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Models\ContractType;
use App\Models\Message;
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
            return response("Your access to this Ticket has been revoked", 401);
        return view("ticket", ["ticket" => $ticket]);
    }

    public function showBytoken(Request $request)
    {

        $ticket = Ticket::where("token", "=", $request->route("token"))->get()->first();

        if(!is_null(Auth::user()) && !Auth::user()->isCraftsman())
            return redirect(route("ticket", $ticket->id));

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

    public function showCreate(Request $request, Condominium $condominium)
    {
        if (Auth::user()->cannot("create", Ticket::class))
            return response("401", 401);
        return view("createTicket", [
            "condominium" => $condominium,
            "urgencies" => Urgency::all(),
            "contractTypes" => ContractType::all(),
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
        $condominiumId = json_decode($request->get("condominium"))->id;

        $ticket = new Ticket();
        if (!is_null($request->get("contractType")))
            $ticket->contract_type_id = $request->get("contractType");
        if (!is_null($request->get("price")))
            $ticket->price = str_replace(",", ".", $request->get("price"));

        $ticket->urgency_id = $request->get("urgency");
        $ticket->tag_id = $request->get("tag");
        $ticket->status_id = 1;
        $ticket->user_id = Auth::user()->id;
        $ticket->condominium_id = $condominiumId;
        $ticket->title = $request->get("title");
        $ticket->desc = $request->get("desc");
        $ticket->phone = $request->get("phone");
        if (Auth::user()->hasFamily()) {
            $ticket->family_id = Auth::user()->family_id;
        }
        $ticket->save();
        //make ticket seen by current user
        $userticket = new \App\Models\UserTickets();
        $userticket->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $userticket->ticket_id = $ticket->id;
        $userticket->seen = true;
        $userticket->save();

        if (!Auth::user()->isAdmin()) {
            $admin = User::where("id", "=", $ticket->condominium()->admin_id)->get()->first();
            if ($admin->setting()->recive_ticket_created_notification) {
                $admin->notify(
                    new TicketCreatedNotification(Auth::user()->name(), $ticket, $ticket->condominium())
                );
            }
        }
        $families = $ticket->condominium()->families()->get();
        foreach ($families as $fam) {
            $user = $fam->user();
            if ($user->id != Auth::user()->id && $user->setting()->recive_ticket_created_notification) {
                $user->notify(
                    new TicketCreatedNotification(Auth::user()->name(), $ticket, $ticket->condominium())
                );
            }
        }

        return redirect(route("condominium", $condominiumId));
    }

    public function addToCraftsman(Request $request)
    {
        $token = $request->get("link");
        return redirect($token);
    }

    public function complete(Ticket $ticket)
    {
        if (Auth::user()->cannot("completeTicket", $ticket))
            return response("401", 401);
        $ticket->status_id = 4;
        $ticket->save();
        return redirect(route("condominium", $ticket->condominium_id));
    }

    public function addCraftsmanToTicket(Ticket $ticket, User $user)
    {
        if (Auth::user()->cannot("addCraftsman", $ticket))
            return response("401", 401);
        $ticket->addCraftsman($user);
        $ticket->save();
        return redirect()->back()->with('success', "saved");
    }

    public function markAsInProgress(Request $request, Ticket $ticket)
    {
        if (Auth::user()->cannot("markAsInProgress", $ticket))
            return response("401", 401);
        $ticket->status_id = 3;
        $ticket->save();
        return redirect(route("ticket", $ticket->id));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            "title" => "required",
            'desc' => "required",
        ]);
        $whatChanged = Auth::user()->name() . " changed ";
        $somethingChanged = false;

        if (!is_null($request->get("title")))
            if ($ticket->title != $request->get("title")) {
                $whatChanged = $whatChanged . " Title to: " . $request->get("title");
                $somethingChanged = true;
            }
        if (!is_null($request->get("desc")))
            if ($ticket->desc != $request->get("desc")) {
                $whatChanged = $whatChanged . " Description to: " . $request->get("desc");
                $somethingChanged = true;
            }
        if (!is_null($request->get("phone")))
            if ($ticket->phone != $request->get("phone")) {
                $whatChanged = $whatChanged . " Phone to: " . $request->get("phone");
                $somethingChanged = true;
            }
        if (!is_null($request->get("status")))
            if ($ticket->status_id != $request->get("status")) {
                $whatChanged = $whatChanged . " Status to: " . Status::where("id", "=", $request->get("status"))->get()->first()->name();
                $somethingChanged = true;
            }
        if (!is_null($request->get("tag")))
            if ($ticket->tag_id != $request->get("tag")) {
                $whatChanged = $whatChanged . " Tag to: " . Tag::where("id", "=", $request->get("tag"))->get()->first()->name();
                $somethingChanged = true;
            }
        if (!is_null($request->get("urgency")))
            if ($ticket->urgency_id != $request->get("urgency")) {
                $whatChanged = $whatChanged . " Urgency to: " . Urgency::where("id", "=", $request->get("urgency"))->get()->first()->name();
                $somethingChanged = true;
            }
        if (!is_null($request->get("contractType")))
            if ($ticket->contract_type_id != $request->get("contractType")) {
                $whatChanged = $whatChanged . "Contract Type to: " . ContractType::where("id", "=", $request->get("contractType"))->get()->first()->name();
                $somethingChanged = true;
            }
        if (!is_null($request->get("price")) && strlen($request->get("price")) > 0)
            if ($ticket->price != $request->get("desc")) {
                $whatChanged = $whatChanged . " Price to: " . $request->get("price");
                $somethingChanged = true;
            }

        if ($somethingChanged) {
            $message = new Message();
            $message->chat_id = $ticket->chat()->id;
            $message->message = $whatChanged;
            $message->save();
        }
        if (!is_null($request->get("contractType")))
            $ticket->contract_type_id = $request->get("contractType");
        if (!is_null($request->get("price")))
            $ticket->price = str_replace(",", ".", $request->get("price"));
        if (!is_null($request->get("title")))
            $ticket->title = $request->get("title");
        if (!is_null($request->get("phone")))
            $ticket->phone = $request->get("phone");
        if (!is_null($request->get("desc")))
            $ticket->desc = $request->get("desc");
        if (!is_null($request->get("status")))
            $ticket->status_id = $request->get("status");
        if (!is_null($request->get("tag")))
            $ticket->tag_id = $request->get("tag");
        if (!is_null($request->get("urgency")))
            $ticket->urgency_id = $request->get("urgency");

        $ticket->save();
        return redirect(route("ticket", $ticket->id))->with('success', "saved");

    }
}
