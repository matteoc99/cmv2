<?php

namespace App\Models;

use App\Resolvers\PaymentPlatformResolver;
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
        if(is_null($this->platform_id))
            return true;
        $paymentPlatformResolver= new PaymentPlatformResolver();
        $paymentPlatform = $paymentPlatformResolver->resolveService($this->platform_id);
        return $paymentPlatform->isActiveSubscription($this->subscription_id);
    }
}
