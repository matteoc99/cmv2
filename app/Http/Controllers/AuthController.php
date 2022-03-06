<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function changePassword (Request $request){
        $request->validate([
            'password' => 'min:6|required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ]);
        $user = Auth::user();
        $user->password=bcrypt($request->get("password"));
        $user->change_password=false;
        $user->save();

        return redirect("dashboard");
    }

    public function login(Request $request){

        $details = $request->only(["email","password"]);

        if(Auth::attempt($details,!is_null($request->get('remember')))){
            return redirect("dashboard");
        }
        return redirect("login")->with("credError",true);

    }

   public function logout (Request $request){
       Auth::logout();
       return redirect("/");
   }

    public function registerWithToken(Request $request, $token){

    }
    public function register(Request $request){



        $request->validate([
            "name" => "required",
            'email' => "required|email|unique:users",
            'password' => 'min:6|required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            "role" => "required",
        ]);


        $details = $request->only(["email","password"]);

        $emailInUse = User::where("email","like",$request->get("email"))->get()->first();

        if(!is_null($emailInUse)){
            return Redirect::back()->withErrors(['errors' => ["email","Email already in unse"]]);
        }

        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->role_id=$request->get("role");

        $user->save();

        Auth::attempt($details);

        $token =$request->get("token");
        if(strlen($token)>5){
            $ticket = Ticket::where("token","=",$token)->get()->first();
            $ticket->addCraftsman(Auth::user());
        }

        return redirect("dashboard");
    }
}
