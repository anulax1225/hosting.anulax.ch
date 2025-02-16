<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExposedPort extends Model
{
    protected $fillable = [
        'number',
        'usable'
    ];
}
