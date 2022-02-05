<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isAdministrator()
    {
        return Auth::user()->role_id == 2;
    }

    public function isCraftsman()
    {
        return Auth::user()->role_id == 3;
    }

    public function isUser()
    {
        return Auth::user()->role_id == 1;
    }
    public function isMaster()
    {
        return Auth::user()->role_id == 4;
    }
}
