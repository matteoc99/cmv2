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

    public function recursiveDelete(){
        $childs = Document::where("parent_id","=",$this->id)->get();
        foreach ($childs as $child){
            $child->recursiveDelete();
        }


        if(!is_null($this->uuid)){
            $fileName = $this->uuid . '.' . $this->mime_type;
            $con= Condominium::where("id","=",$this->condominium_id)->get()->first();
            unlink(public_path('uploads/' . $con->uuid . "/". $fileName));
        }

        $this->delete();
    }
}
