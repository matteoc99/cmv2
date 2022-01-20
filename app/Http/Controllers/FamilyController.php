<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{

    public function showCreate(Request $request)
    {
        if(Auth::user()->cannot("create",Family::class))
            return response("401",401);
        return view("createFamily");
    }

    public function create(Request $request)
    {
        if(Auth::user()->cannot("create",Family::class))
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
