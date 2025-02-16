<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        "uuid",
        'name',
        "image", 
        "config",
        "ports",
        "protocol"
    ];

    public function servers()
    {
        return $this->hasMany(Server::class);
    }
}
