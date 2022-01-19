<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CondominiumController extends Controller
{
    public function create(Request $request)
    {
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
