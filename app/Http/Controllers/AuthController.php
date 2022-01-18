<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $details = $request->only(["email","password"]);

        if(Auth::attempt($details)){
            return redirect("dashboard");
        }
        return redirect("login")->with("credError",true);

    }
   public function logout (Request $request){
       Auth::logout();
       return redirect("/");
   }

    public function register(Request $request){

        $request->validate([
            "name" => "required",
            'email' => "required|email",
            'password' => 'min:6|required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            "role" => "required",
        ]);


        $details = $request->only(["email","password"]);

        $emailInUse = User::where("email","like",$request->get("email"))->get();

        if($emailInUse->get("items") != null){
            return Redirect::back()->withErrors(['errors' => ["email","Email already in unse"]]);
        }

        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->role_id=$request->get("role");

        $user->save();

        Auth::attempt($details);

        return redirect("dashboard");
    }
}
