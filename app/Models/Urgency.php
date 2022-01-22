<?php

namespace App\Models;

use App\Http\Middleware\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urgency extends Model
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
