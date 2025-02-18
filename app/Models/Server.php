<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        "uuid",
        'name',
        "container",
        "start",
        "end",
        "public",
        "service_id",
        "user_id",
        "status_id",
    ];

    public function jsonSerialize(): mixed
    {
        return [
            "uuid" => $this->uuid,
            'name' => $this->name,
            "start" => $this->start,
            "end" => $this->end,
            "public" => $this->public,
            "service" => $this->service,
            "user" => $this->user,
            "status" => $this->status,
            "ports" => $this->exposedPorts()->pluck("number"),
        ];
    }

    public function exposedPorts()
    {
        return $this->belongsToMany(ExposedPort::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
