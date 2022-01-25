<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'message',
    ];

    public function getFile(){
        $file = "";
        if($this->hasFile()){
            $file = asset("uploads/".$this->uuid.".".$this->mime_type);
        }
        return $file;
    }

    public function hasImage()
    {
       return $this->hasFile()&&in_array($this->mime_type,["jpg","png","jpeg"]);
    }
    public function hasFile()
    {
        return !is_null($this->uuid)&&strlen($this->uuid)>1;
    }


}
