<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyImportDTO;
use App\Models\User;
use App\Notifications\InviteUserNotification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ImportController extends Controller
{
    public function userExcelImport(Request $request){

        $condominium = json_decode($request->condominium)->id;

        try{
            $families= Excel::toArray(new FamilyImportDTO(),request()->file('excel'));
            foreach ($families[0] as $family){
                if(!is_null(User::where("email",$family[1])->get()->first()))
                    return redirect()->back()->withErrors("Import Failed, the email: ". $family[1] . " is already in use");
                $this->createFamily($family,$condominium);
            }
            return redirect(route("condominium",$condominium));
        }catch (Throwable $e){
            return redirect()->back()->withErrors("Import Failed, check the file type and format");
        }
    }

    private function createFamily($family,$condominium)
    {

        $fam = new Family();
        $fam->name = $family[0];
        $fam->condominium_id = $condominium;

        $fam->save();


        $user = new User();
        $user->name = $fam->name;
        $user->email = $family[1];
        $pass = str_random(12);
        $user->password = bcrypt($pass);
        $user->role_id = 1;
        $user->family_id = $fam->id;
        $user->change_password = true;
        $user->save();
        $fam->user_id = $user->id;
        $fam->save();
        $user->notify(
            new InviteUserNotification($pass, $user->email)
        );
    }
}
