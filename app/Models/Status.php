<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function name(){
        $loc = app()->getLocale();
        $name = $this->nameEn;
        if($loc=="de"){
            $name = $this->nameDe;
        }elseif ($loc == "it"){
            $name = $this->nameIt;
        }
        return $name;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
