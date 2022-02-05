<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'active_until',
        'user_id',
        'plan_id',
    ];
    protected $casts = [
        'active_until' => 'date',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class)->get()->first();
    }
    public function user(){
        return $this->belongsTo(User::class)->get()->first();
    }

    public function isActive(){
        return $this->active_until->gt(now());
    }
}
