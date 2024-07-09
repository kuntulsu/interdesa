<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $fillable = ['year', 'month'];


    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
