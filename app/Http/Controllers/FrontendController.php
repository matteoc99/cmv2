<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function language(Request $request){
            session(['my_locale' => $request->route('locale')]);
            return redirect()->back();
    }
    public function showLanding(Request $request){
        if(!is_null(Auth::user())){
            return (new DashboardController)->show($request);
        }
        return view("landing");
    }
}
