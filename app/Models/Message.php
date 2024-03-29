<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function chat()
    {
        return $this->belongsTo(Chat::class)->get()->first();
    }

    public function hasImage()
    {
       return $this->hasFile()&&in_array($this->mime_type,["jpg","png","jpeg"]);
    }
    public function hasFile()
    {
        return !is_null($this->uuid)&&strlen($this->uuid)>1;
    }

    public function isNew()
    {
        return is_null(Auth::user()->seenMessages()->where("message_id", "=", $this->id)->get()->first());
    }


}
