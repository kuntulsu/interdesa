<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "servers";


    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
    public function profiles()
    {
        return $this->hasMany(ServerProfile::class);
    }
    public function connect(): Mikrotik
    {
        return new Mikrotik($this->hostname, $this->username, $this->password, $this->port);
    }

    protected function casts(): array
    {
        return [
            "password" => "encrypted"
        ];
    }
}
