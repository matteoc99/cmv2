<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public function hasPicture(){
        return !is_null($this->profile_picture_id);
    }

    public function picture(){
        return $this->belongsTo('App\Models\Picture',"profile_picture_id","id")->get()->first();
    }
}
