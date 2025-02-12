<?php

namespace App\Docker;

use Exception;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\UnixConnector;


class Container 
{
    protected $id;
    protected $connector;
    protected $browser;

    public function __construct($id) 
    {
        $this->id = $id;
        $this->connector = new FixedUriConnector(
            'unix:///var/run/docker.sock',
            new UnixConnector()
        );
        $this->browser = new Browser($this->connector);
    
    }

    public function getId() { return $this->id; }

    public function start($context) 
    {
        $context = $context ?? [ "onSucces" => function() {}, "onError" => function() {}];
        try {
            $this->browser->post("http://localhost/containers/" . $this->id . "/start", [ "Content-Type" => "text/plain" ])
            ->then(function(ResponseInterface $response) use($context) {
                $data = json_decode($response->getBody());
                return $context["onSucces"]($this, $data);
            }, function($e) use($context) {
                return $context["onError"]($e);
            });
        } catch (Exception $e) {
            return $context["onError"]($e);
        }
    }

    public function restart($context) 
    {
        $context = $context ?? [ "onSucces" => function() {}, "onError" => function() {}];
        try {
            $this->browser->post("http://localhost/containers/" . $this->id . "/restart", [ "Content-Type" => "text/plain" ])
            ->then(function(ResponseInterface $response) use($context) {
                $data = json_decode($response->getBody());
                return $context["onSucces"]($this, $data);
            }, function($e) use($context) {
                return $context["onError"]($e);
            });
        } catch (Exception $e) {
            return $context["onError"]($e);
        }
    }

    public function stop($context) 
    {
        $context = $context ?? [ "onSucces" => function() {}, "onError" => function() {}];
        try {
            $this->browser->post("http://localhost/containers/" . $this->id . "/stop", [ "Content-Type" => "text/plain" ])
            ->then(function(ResponseInterface $response) use($context) {
                $data = json_decode($response->getBody());
                return $context["onSucces"]($this, $data);
            }, function($e) use($context) {
                return $context["onError"]($e);
            });
        } catch (Exception $e) {
            return $context["onError"]($e);
        }
    }

    public function kill($context) 
    {
        $context = $context ?? [ "onSucces" => function() {}, "onError" => function() {}];
        try {
            $this->browser->post("http://localhost/containers/" . $this->id . "/kill", [ "Content-Type" => "text/plain" ])
            ->then(function(ResponseInterface $response) use($context) {
                $data = json_decode($response->getBody());
                return $context["onSucces"]($this, $data);
            }, function($e) use($context) {
                return $context["onError"]($e);
            });
        } catch (Exception $e) {
            return $context["onError"]($e);
        }
    }

    public function inspect($context)
    {
        $context = $context ?? [ "onSucces" => function() {}, "onError" => function() {}];
        try {
            $this->browser->post("http://localhost/containers/" . $this->id . "/json?size=" . $context["size"] ?? false, [ "Content-Type" => "text/plain" ])
            ->then(function(ResponseInterface $response) use($context) {
                $data = json_decode($response->getBody());
                return $context["onSucces"]($this, $data);
            }, function($e) use($context) {
                return $context["onError"]($e);
            });
        } catch (Exception $e) {
            return $context["onError"]($e);
        }
    }

    public static function create($name, $config, $context)
    {
        $context = $context ?? [ "onSucces" => function() {}, "onError" => function() {}];
        try {
            $connector = new FixedUriConnector(
                'unix:///var/run/docker.sock',
                new UnixConnector()
            );
            $browser = new Browser($connector);
            
            $browser->post('http://localhost/containers/create?name='. $name, [ "Content-Type" => "application/json" ], json_encode($config))
            ->then(function (ResponseInterface $response) use($context) {
                $data = json_decode($response->getBody());
                $container = new Container($data->Id);
                return $context["onSucces"]($container);
            }, $context["onError"]);
        } catch (Exception $e) {
            return $context["onError"]($e);
        }
    }
}