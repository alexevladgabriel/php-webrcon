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

    public function sendPacket(string $command)
    {
        $data = array(
            'Identifier' => 1001,
            'Message' => $command, // command
            'Stacktrace' => '',
            'Type' => 3
        );
        $this->client->send(json_encode($data));
        $this->response = json_decode($this->client->receive(), true);
    }

    public function GetMessage(): array
    {
        return json_decode($this->response["Message"], true);
    }

    public function __destruct()
    {
        $this->client = null;
    }
}
