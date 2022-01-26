<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimateController extends Controller
{


    public function approve(Estimate $estimate)
    {
        $estimate->approved = true;
        $ticket = Ticket::where("id", "=", $estimate->ticket_id)->get()->first();
        $ticket->status_id=3;
        if($estimate->user_id !== $ticket->craftsman_id)
            $ticket->craftsman_id=$estimate->user_id;
        $ticket->save();
        $estimate->save();
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $estimate = new Estimate();
        $estimate->desc = $request->get("description");
        $estimate->price = $request->get("price");
        $estimate->estimated_completition = $request->get("estimated");
        $estimate->ticket_id = $request->get("ticket");
        $estimate->user_id = Auth::user()->id;

        $estimate->save();
        return redirect()->back();
    }
}
