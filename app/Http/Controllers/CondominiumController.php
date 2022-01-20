<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CondominiumController extends Controller
{
    public function show(Condominium $condominium)
    {
        if(Auth::user()->cannot("view",$condominium))
            return response("401",401);
        return view("tickets",["families"=>$condominium->families()->get()]);
    }
    public function showCreate(Request $request)
    {
        if(Auth::user()->cannot("create",Condominium::class))
            return response("401",401);
        return view("createCondominium");
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
        ]);

        $con = new Condominium();
        $con->name=$request->get("name");
        $con->address=$request->get("address");
        $con->lat=$request->get("lat");
        $con->lng=$request->get("lng");
        $con->admin_id=Auth::id();
        $con->save();
        return redirect("dashboard");

    }
}
