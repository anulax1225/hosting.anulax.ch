<?php

namespace App\Docker;

use Exception;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\UnixConnector;
use function React\Async\await;


class Container 
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

    public function start() 
    {
        try {
            $response = await($this->browser->post(Docker::endpoint("/containers/" . $this->id . "/start"), [
                 "Content-Type" => "text/plain" 
            ]));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function restart($context) 
    {
        $context = $context ?? [ "onSuccess" => function() {}, "onError" => function() {}];
        try {
            $response = await($this->browser->post(
                Docker::endpoint("/containers/" . $this->id . "/restart"), 
                [ "Content-Type" => "text/plain" ]
            ));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function stop($context) 
    {
        $context = $context ?? [ "onSuccess" => function() {}, "onError" => function() {}];
        try {
            $response = await($this->browser->post(
                Docker::endpoint("/containers/" . $this->id . "/stop"), 
                [ "Content-Type" => "text/plain" ]
            ));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function kill($context) 
    {
        $context = $context ?? [ "onSuccess" => function() {}, "onError" => function() {}];
        try {
            $response = await($this->browser->post(
                Docker::endpoint("/containers/" . $this->id . "/kill"), 
                [ "Content-Type" => "text/plain" ]
            ));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function inspect($size = false)
    {
        try {
            $response = await($this->browser->post(
                Docker::endpoint("/containers/" . $this->id . "/json?size=" . $size), 
                [ "Content-Type" => "text/plain" ]
            ));
            return json_decode($response->getBody());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function create($name, $config)
    {
        try {
            $connection = Docker::connect();
            $response = await($connection->browser->post(Docker::endpoint('/containers/create?name='. $name), 
                [ "Content-Type" => "application/json" ], 
                json_encode($config)
            ));
            $data = json_decode($response->getBody());
            $container = new Container($data->Id);
            return $container;
        } catch (Exception $e) {
            throw $e;
        }
    }
}