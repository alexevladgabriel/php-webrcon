<?php

namespace Scai;

use WebSocket\Client;

class RustRcon
{
    private $client;
    public function __construct(string $ip, int $port, string $pass)
    {
        $this->client = new Client("ws://{$ip}:{$port}/{$pass}");
    }

    public function sendPacket(string $command): mixed
    {
        $data = array(
            'Identifier' => 1001,
            'Message' => $command, // command
            'Stacktrace' => '',
            'Type' => 3
        );
        $this->client->send(json_encode($data));

        return json_decode($this->client->receive(), true);
    }

    public function __destruct()
    {
        $this->client = null;
    }
}
