<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function getFile(){
        $file = "";
        if($this->hasFile()){
            $con = Condominium::where("id","=",$this->condominium_id)->get()->first();
            $file = asset("uploads/".$con->uuid ."/".$this->uuid.".".$this->mime_type);
        }
        return $file;
    }

    public function hasFile()
    {
        return !is_null($this->uuid)&&strlen($this->uuid)>1;
    }
}
