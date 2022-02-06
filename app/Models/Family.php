<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class)->get()->first();
    }
    public function condominium()
    {
        return $this->hasOne(User::class)->get()->first();
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getIsUserDeletedAttribute(){
        return $this->user()->deleted;
    }
}
