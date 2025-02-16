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
    /**
     * Create a new job instance.
     */
    public function __construct($server)
    {
        $this->server = $server;
        $server->update(["status_id" => 2]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $config = config($this->server->service->config);
            $ports = explode("|", $this->server->service->ports);
            for ($i = 0; $i < count($ports); $i++) {
                $port = ExposedPort::where("usable", true)->first();
                if(!$port) throw new Exception("All ports are used, please try later.");
                $this->server->exposedPorts()->attach($port->id);
                $port->update(["usable" => false]);
                $config["ExposedPorts"][$ports[$i] . "/" . $this->server->service->protocol] = (object)[];
                $config["HostConfig"]["PortBindings"][$ports[$i] . "/" . $this->server->service->protocol] = [[ "HostPort" =>  "" . $port->number ]];
            }
            Log::info(json_encode($config, JSON_UNESCAPED_SLASHES));
            $container = Container::create($this->server->name . Str::random(5), $config);
            $container->start();
            $this->server->update([
                "container" => $container->getId(),
                "status_id" => 1,
                "start" => now()
            ]);
        }catch(Exception $e) {
            $this->fail($e);
        }
    }

    public function fail($e): void
    {
        $this->server->update([
            "status_id" => 4,
            "end" => now()
        ]);
        $this->server->exposedPorts()->detach();
        Log::info($e->getResponse()->getBody());
    }
}
