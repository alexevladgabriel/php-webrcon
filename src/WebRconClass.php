<?php

namespace Scai\WebRcon;

use WebSocket\BadOpcodeException;
use WebSocket\Client;

class WebRconClass
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var array
     */
    private array $response = [];

    const LAST_INDEX = 1001;

    /**
     * @param string $ip
     * @param int $port
     * @param string $password
     */
    public function __construct(string $ip, int $port, string $password)
    {
        $this->client = new Client("ws://{$ip}:{$port}/{$password}");
    }

    /**
     * @param string $command
     * @param int $identifier
     * @param string $name
     * @return array
     * @throws BadOpcodeException
     */
    public function command(string $command, int $identifier = self::LAST_INDEX, string $name = "WebRcon"): array
    {
        $this->client->send(json_encode(array(
            'Identifier' => $identifier,
            'Message' => $command,
            'Name' => $name
        )));

        return $this->response = array_map(function ($json) {
            return json_decode($json, true);
        }, json_decode($this->client->receive(), true));
    }

    /**
     * @return array
     */
    public function receive(): array
    {
        return $this->response["Message"];
    }
}
