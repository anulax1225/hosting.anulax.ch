<?php

namespace App\Jobs;

use App\Docker\Container;
use App\Models\ExposedPort;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InitServer implements ShouldQueue
{
    use Queueable;

    protected $server;
    protected $config;
    protected $launch;
    /**
     * Create a new job instance.
     */
    public function __construct($server, $config, $launch)
    {
        $this->server = $server;
        $this->launch = $launch;
        $this->config = $config;
        $server->update(["status_id" => 2]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $container = Container::create($this->server->name . Str::random(5), $this->config);
            if($this->launch) {
                $container->start();
                $this->server->update([
                    "container" => $container->getId(),
                    "status_id" => 1,
                    "start" => now(),
                    "end" => now()
                ]);
            } else {
                $this->server->update([
                    "container" => $container->getId(),
                    "status_id" => 3,
                    "end" => now()
                ]);
            }
        }catch(Exception $e) {
            $this->fail($e);
        }
    }

    public function fail($e): void
    {
        $this->server->update([
            "status_id" => 4,
        ]);
        $this->server->exposedPorts()->detach();
        Log::info(((object)$e)->getResponse()->getBody());
    }
}
