<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function name()
    {
        $name = $this->name;
        if (!is_null($this->setting()->firm_name)&& strlen($this->setting()->firm_name)>0)
            $name = $this->setting()->firm_name;
        if (!is_null($this->setting()->first_name)&& strlen($this->setting()->first_name)>0) {
            $name = $this->setting()->first_name;
            if (!is_null($this->setting()->last_name) && strlen($this->setting()->last_name)>0)
                $name = $name . " " . $this->setting()->last_name;
        }
        return $name;
    }

    public function administrates()
    {
        return $this->hasMany('App\Models\Condominium', "admin_id", "id");
    }

    public function family()
    {
        return $this->hasOne('App\Models\Family')->get()->first();
    }

    public function setting()
    {
        if (is_null($this->setting_id)) {
            $set = new Setting();
            $set->save();
            $this->setting_id = $set->id;
            $this->save();
        }
        return $this->belongsTo('App\Models\Setting')->get()->first();
    }

    public function isUser()
    {
        return $this->role_id === 1;
    }

    public function isAdmin()
    {
        return $this->role_id === 2;
    }

    public function isCraftsman()
    {
        return $this->role_id === 3;
    }

    public function hasFamily()
    {
        return !is_null($this->family_id);
    }

    public function seenTickets()
    {
        return $this->belongsToMany(Ticket::class, "user_ticket")
            ->using(UserTickets::class)->withPivot("seen");
    }

    public function userTags()
    {
        return $this->belongsToMany(Tag::class, "user_tag")
            ->using(UserTag::class);
    }

    public function hasTag($tag)
    {
        $tags = $this->userTags()->where("id", "=", $tag)->get();
        return is_countable($tags) && count($tags) >= 1;
    }

    public function profilePicture(){
        $set=$this->setting();
        $img =asset("uploads/default.jpg");
        if($set->hasPicture()){
            $img = asset("uploads/".$set->picture()->uuid.".".$set->picture()->mime_type);
        }
        return $img;
    }

    public function subscription()
    {
        $subscription=$this->hasOne(Subscription::class)->get()->first();
        if(is_null($subscription)){
            $subscription = new Subscription();
            $plan = Plan::where("id","=",1)->get()->first();
            $subscription->user_id= Auth::user()->id;
            $subscription->plan_id= $plan->id;
            $subscription->active_until= now();
            $subscription->save();
        }
        return $subscription;
    }

    public function hasActiveSubscription()
    {
        return optional($this->subscription())->isActive() ?? false;
    }
}
