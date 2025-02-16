<?php

namespace App\Docker;

use Exception;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\UnixConnector;
use function React\Async\await;


class Exec 
{
    protected $id;
    protected $connector;
    protected $browser;

    public function __construct($id) 
    {
        $this->id = $id;
        $connection = Docker::connect();
        $this->connector = $connection->connector;
        $this->browser = $connection->browser;
    }

    public function getId() { return $this->id; }

    public function start($args = []) 
    {
        try {
            Log::info("Starting exec :" . Docker::endpoint("/exec/" . $this->id . "/start"));
            $response = await($this->browser->post(
                Docker::endpoint("/exec/" . $this->id . "/start"), 
                [ "Content-Type" => "application/json"],
            ));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function inspect()
    {
        try {
            $response = await($this->browser->get(
                Docker::endpoint("/exec/" . $this->id . "/json"), 
                [ "Content-Type" => "text/plain" ]
            ));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }
}