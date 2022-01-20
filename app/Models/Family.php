<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function condominium()
    {
        return $this->hasOne(User::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
