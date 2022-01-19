<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominium extends Model
{
    use HasFactory;
    public function Admin(){
        return $this->belongsTo('App\Models\User',"admin_id","id");
    }
    public function families()
    {
        return $this->hasMany(Family::class);
    }
}
