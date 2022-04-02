<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Models\Family;
use App\Models\User;
use App\Notifications\InviteUserNotification;
use App\Notifications\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    public function showCreate(Request $request, Condominium $condominium)
    {
        if (Auth::user()->cannot("create", Family::class))
            return response("401", 401);
        return view("createFamily", ["condominium" => $condominium]);
    }

    public function showEdit(Request $request, Condominium $condominium, Family $family)
    {
        if (Auth::user()->cannot("update", $family))
            return response("401", 401);
        return view("editFamily", ["condominium" => $condominium, "family" => $family]);
    }

    public function update(Request $request, Family $family)
    {
        if (Auth::user()->cannot("update", $family))
            return response("401", 401);
        $request->validate([
            "name" => "required",
        ]);
        $condominiumId = $family->condominium_id;
        $family->count = $request->get("count");
        $family->name = $request->get("name");
        $family->save();
        return redirect(route("condominium", $condominiumId));

    }

    public function delete(Family $family)
    {
        if (Auth::user()->cannot("delete", $family))
            return response("401", 401);
        $condominiumId = $family->condominium_id;
        $user=$family->user();
        $user->markAsDeleted();
        $user->back_up_email = $user->email;
        $user->email=str_random(40);
        $user->save();
        return redirect(route("condominium", $condominiumId));
    }
    public function create(Request $request)
    {
        if (Auth::user()->cannot("create", Family::class))
            return response("401", 401);
        $request->validate([
            "name" => "required",
            'email' => "required|unique:users",
        ]);

        $condominiumId = json_decode($request->get("condominium"))->id;

        $fam = new Family();
        $fam->name = $request->get("name");
        $fam->count = $request->get("count");
        $fam->condominium_id = $condominiumId;

        $fam->save();


        $user = new User();
        $user->name = $fam->name;
        $user->email = $request->get("email");
        $pass = str_random(12);
        $user->password = bcrypt($pass);
        $user->role_id = 1;
        $user->family_id = $fam->id;
        $user->change_password = true;
        $user->save();
        $fam->user_id = $user->id;
        $fam->save();
        $user->notify(
            new InviteUserNotification($pass, $user->email)
        );

        return redirect(route("condominium", $condominiumId));

    }
}
