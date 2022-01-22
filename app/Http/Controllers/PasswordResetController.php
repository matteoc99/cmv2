<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'min:6|required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        $user = User::where('email', $passwordReset->email)->first();
        if(!is_null($user)){
            $user->password = bcrypt($request->password);
            $user->save();
            $passwordReset->delete();
            $user->notify(new PasswordResetSuccess());
        }
        return redirect("login");
    }

    public function showReset(Request $request)
    {
        return view("auth/passwordReset");
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return redirect("login");

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60),
            ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return redirect("login");
    }

}
