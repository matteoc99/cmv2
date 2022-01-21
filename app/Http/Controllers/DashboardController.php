<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(Request $request){
        if($this->isAdministrator()){
            return $this->showCondominiums($request);
        }else if($this->isCraftsman()){
            return $this->showTickets($request);
        }else{
            return $this->showCondominium($request);
        }
    }
    public function showCondominiums(Request $request)
    {
        return view("dashboard",["condominia"=>Auth::user()->administrates()->get()]);
    }
    public function showCondominium(Request $request)
    {
        $fam=Auth::user()->family();
        return redirect(route("condominium",$fam->condominium_id));
    }
    public function showTickets(Request $request)
    {
        return view("condominium",["families"=>null,"tickets"=>null]); //TODO add tickets of craftsman

    }
}
