<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyImportDTO extends Model
{
    use HasFactory;
    protected $fillable=["name","email"];
}
