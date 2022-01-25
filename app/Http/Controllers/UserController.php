<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){

        return view("profile",[
            "img"=>$user->profilePicture(),
            "name"=>$user->name(),
            "user"=> $user,
            "set"=>$user->setting()
        ]);
    }
}
