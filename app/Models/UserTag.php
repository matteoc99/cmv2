<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTag extends Pivot
{
    protected $primaryKey = ['user_id','tag_id'];
}
