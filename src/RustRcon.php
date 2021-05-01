<?php

namespace Scai;

use WebSocket\Client;

class RustRcon
{
    private $client;
    private $response;

    public function __construct(string $ip, int $port, string $pass)
    {
        $this->client = new Client("ws://{$ip}:{$port}/{$pass}");
    }

    public function sendPacket(string $command): array
    {
        $data = array(
            'Identifier' => 1001,
            'Message' => $command, // command
            'Stacktrace' => '',
            'Type' => 3
        );

        $this->client->send(json_encode($data));

        return $this->response = array_map(function ($json) {
            return json_decode($json, true);
        }, json_decode($this->client->receive(), true));
    }

    public function getMessage(): array
    {
        return $this->response["Message"];
    }

    public function __destruct()
    {
        $this->client = null;
    }
}
