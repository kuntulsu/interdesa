<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;


    public function server()
    {
        return $this->belongsTo(Server::class);

    }
    protected function casts()
    {
        return [
            "jatuh_tempo" => 'date'
        ];
    }
    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

}
