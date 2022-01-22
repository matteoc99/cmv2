<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){

        $set=$user->setting();
        $img =asset("uploads/default.jpg");
        if($set->hasPicture()){
            $img = asset("uploads/".$set->picture()->uuid.".".$set->picture()->mime_type);
        }
        $name = $set->first_name . " " . $set->last_name;
        if($user->isCraftsman())
            $name = $set->firm_name;
        return view("profile",[
            "img"=>$img,
            "name"=>$name,
            "user"=> $user,
            "set"=>$set
        ]);
    }
}
