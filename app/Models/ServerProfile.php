<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerProfile extends Model
{
    use HasFactory;
    protected $fillable = ["profile_id", "price"];
}
