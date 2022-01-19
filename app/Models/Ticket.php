<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function urgency()
    {
        return $this->belongsTo(Urgency::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function craftsman()
    {
        return $this->belongsTo('App\Models\User',"craftsman_id","id");
    }
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

}
