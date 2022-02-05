<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function subscriptions()
    {
        $this->hasMany(Subscription::class);
    }

    public function getVisualPriceAttribute()
    {
        return "$" . number_format($this->price/100,2,".",",");
    }

    public function getDurationInDaysAttribute()
    {
        return "$" . number_format($this->price/100,2,".",",");
    }
}
