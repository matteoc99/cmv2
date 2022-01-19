<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(Request $request){
        if($this->isAdministrator()){
            return $this->showCondominiums($request);
        }else{
            return $this->showTickets($request);
        }

    }
    public function showCondominiums(Request $request)
    {
        return view("dashboard",["condominia"=>Auth::user()->Administrates()->get()]);
    }

    public function showTickets(Request $request)
    {
        return view("tickets");

    }
}
