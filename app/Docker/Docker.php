<?php

namespace App\Docker;

use Exception;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\ConnectorInterFace;
use React\Socket\UnixConnector;
use function React\Async\await;


class Docker 
{
    public static function connect($fromSocket = true, $socket = 'unix:///var/run/docker.sock')
    {
        $connector = $fromSocket ? new FixedUriConnector(
            $socket,
            new UnixConnector()
        ) : new ConnectorInterface();
        $browser = new Browser($connector);
        return (object)[ "connector" => $connector, "browser" => $browser ];
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