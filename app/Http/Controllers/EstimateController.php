<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\EstimateApprovedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class EstimateController extends Controller
{


    public function approve(Estimate $estimate)
    {
        $ticket = Ticket::where("id", "=", $estimate->ticket_id)->get()->first();
        if (Auth::user()->cannot("approveEstimates", $ticket))
            return response("401", 401);

        $estimate->approved = true;

        $ticket->status_id = 3;
        $ticket->price = $estimate->price;

        $msg = "";
        switch (App::getLocale()) {
            case "it":
                $msg = "preventivo approvato da: " . Auth::user()->name() . " <br>" . $estimate->desc . " <br>" . $estimate->price . "€ <br> completamento stimato: " . $estimate->estimated_completition;
                break;
            case "de":
                $msg = "Kostenvoranschlag angenommen von : " . Auth::user()->name() . " <br>" . $estimate->desc . " <br>" . $estimate->price . "€ <br> Geschätzte Fertigstellung: " . $estimate->estimated_completition;
                break;
            case "en":
                $msg = "estimate approved by: " . Auth::user()->name() . " <br>" . $estimate->desc . " <br>" . $estimate->price . "€ <br> estimated completition:" . $estimate->estimated_completition;
                break;
        }
        $message = new Message();
        $message->chat_id = $ticket->chat()->id;

        $message->message = $msg;
        $message->save();


        if ($estimate->user_id !== $ticket->craftsman_id)
            $ticket->craftsman_id = $estimate->user_id;
        $craftsman = User::where("id", "=", $estimate->user_id)->get()->first();
        if ($craftsman->setting()->revice_approved_estimate_notification) {
            $craftsman->notify(
                new EstimateApprovedNotification($estimate)
            );
        }
        $ticket->save();
        $estimate->save();
        return redirect()->back();
    }

    public function create(Request $request)
    {


        $ticket = Ticket::where("id", "=", $request->get("ticket"))->get()->first();


        if (Auth::user()->cannot("createEstimate", $ticket))
            return response("401", 401);
        $estimate = new Estimate();
        $estimate->desc = $request->get("description");
        $estimate->price = $request->get("price");
        $estimate->estimated_completition = $request->get("estimated");
        $estimate->ticket_id = $ticket->id;
        $estimate->user_id = Auth::user()->id;

        $estimate->save();

        $msg = "";
        switch (App::getLocale()) {
            case "it":
                $msg = "Nuovo preventivo da: " . Auth::user()->name() . " <br>" . $estimate->desc . " <br>" . $estimate->price . "€ <br> completamento stimato:" . $estimate->estimated_completition;
                break;
            case "de":
                $msg = "Neuer Kostenvoranschlag von : " . Auth::user()->name() . " <br>" . $estimate->desc . " <br>" . $estimate->price . "€ <br> Geschätzte Fertigstellung:" . $estimate->estimated_completition;
                break;
            case "en":
                $msg = "new estimate by: " . Auth::user()->name() . " <br>" . $estimate->desc . " <br>" . $estimate->price . "€ <br> estimated completition:" . $estimate->estimated_completition;
                break;
        }
        $message = new Message();
        $message->chat_id = $ticket->chat()->id;

        $message->message = $msg;
        $message->save();


        return redirect()->back();
    }
}
