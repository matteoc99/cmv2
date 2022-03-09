<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function language(Request $request){
            session(['my_locale' => $request->route('locale')]);
            if(!is_null(Auth::user())){
                $set = Auth::user()->setting();
                $set->language = $request->route('locale');
                $set->save();$request->route('locale');
            }
            return redirect()->back();
    }
    public function showLanding(Request $request){
        if(!is_null(Auth::user())){
            return (new DashboardController)->show($request);
        }
        return view("landing");
    }

    public function cookie_agree()
    {
        Session::put('cookie_shown', 'true');
        return redirect()->back();
    }
    public function privacy()
    {
        return view('privacy');
    }

    public function test(Request $request){
        return Ticket::where("id","=",3)->get()->first()->unreadChatMessages();
    }
}
