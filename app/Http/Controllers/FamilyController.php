<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\User;
use App\Notifications\InviteUserNotification;
use App\Notifications\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'email' => "required|unique:users",
        ]);

        $fam = new Family();
        $fam->name=$request->get("name");
        $fam->count=$request->get("count");
        $fam->condominium_id=$request->get("condominium");

        $fam->save();


        $user = new User();
        $user->name = $fam->name;
        $user->email = $request->get("email");
        $pass = str_random(12);
        $user->password = bcrypt($pass);
        $user->role_id=1;
        $user->family_id=$fam->id;
        $user->change_password =true;
        $user->save();
        $fam->user_id=$user->id;
        $fam->save();
        $user->notify(
            new InviteUserNotification($pass,$user->email)
        );

        return redirect(route("condominium",$request->get("condominium")));

    }
}
