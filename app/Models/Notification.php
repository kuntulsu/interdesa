<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            "client_up_down" => "boolean",
            "server_up_down" => "boolean",
            "secret_created" => "boolean",
            "server_reporting" => "boolean"
        ];
    }
}
