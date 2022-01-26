<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimateController extends Controller
{


    public function create(Request $request){
        $estimate = new Estimate();
        $estimate->desc=$request->get("description");
        $estimate->price=$request->get("price");
        $estimate->estimated_completition=$request->get("estimated");
        $estimate->ticket_id=$request->get("ticket");
        $estimate->user_id=Auth::user()->id;

        $estimate->save();
        return redirect()->back();
    }
}
