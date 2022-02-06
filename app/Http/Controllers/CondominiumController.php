<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Models\Ticket;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CondominiumController extends Controller
{
    public function show(Condominium $condominium)
    {
        if(Auth::user()->cannot("view",$condominium))
            return redirect(route("dashboard"));
        return view("condominium",[
            "condominium"=>$condominium,
            "families"=>$condominium->families()->get()->where("is_user_deleted","=",false),
            "tickets"=>Ticket::where("condominium_id","=",$condominium->id)->get()
        ]);
    }
    public function showCreate(Request $request)
    {
        if(Auth::user()->cannot("create",Condominium::class))
            return response("401",401);
        return view("createCondominium");
    }
    public function showEdit(Condominium $condominium)
    {
        if(Auth::user()->cannot("edit",$condominium))
            return response("401",401);
        return view("editCondominium",["condominium"=>$condominium]);
    }
    public function create(Request $request)
    {
        if(Auth::user()->cannot("create",Condominium::class))
            return response("401",401);
        $request->validate([
            "name" => "required",
            'address' => "required",
            'lat' => 'required',
            "lng" => "required",
            "period" => "required",
        ]);

        $con = new Condominium();
        $con->name=$request->get("name");
        $con->address=$request->get("address");
        $con->lat=$request->get("lat");
        $con->lng=$request->get("lng");
        $con->period=$request->get("period");
        $con->admin_id=Auth::id();
        $con->save();
        return redirect("dashboard");

    }
    public function update(Request $request,Condominium $condominium)
    {
        if(Auth::user()->cannot("edit",$condominium))
            return response("401",401);
        $request->validate([
            "name" => "required",
            'address' => "required",
            'lat' => 'required',
            "lng" => "required",
            "period" => "required",
        ]);

        $condominium->name=$request->get("name");
        $condominium->address=$request->get("address");
        $condominium->lat=$request->get("lat");
        $condominium->lng=$request->get("lng");
        $condominium->period=$request->get("period");
        $condominium->save();
        return redirect()->back()->with('success', "edit");

    }
}
