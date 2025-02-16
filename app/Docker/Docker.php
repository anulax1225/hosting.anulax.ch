<?php

namespace App\Docker;

use Exception;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\Connector;
use React\Socket\UnixConnector;
use function React\Async\await;


class Docker 
{
    static protected $connection = null;

    public static function connect($fromSocket = true, $socket = 'unix:///var/run/docker.sock')
    {
        $connector = $fromSocket ? new FixedUriConnector(
            $socket,
            new UnixConnector()
        ) : null;
        $browser = new Browser($connector);
        Docker::$connection = (object)[ "connector" => $connector, "browser" => $browser ];
        return Docker::$connection;
    }

    public static function endpoint($url)
    {
        return config("docker.endpoint", "http://localhost") . $url;
    }

    public static function info()
    {
        try {
            $connection = Docker::connect();
            $response = await($connection->browser->get(Docker::endpoint('/info')));
            return json_decode($response->getBody());
        } catch(Exception $e) {
            throw $e;
        }
    }
}