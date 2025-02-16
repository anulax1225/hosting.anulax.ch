<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    protected $fillable = [
        "uuid",
        "cpus",
        "memory",
        "storage"
    ];
}
