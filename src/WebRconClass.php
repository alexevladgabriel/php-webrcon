<?php

namespace Scai\WebRcon;

use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use WebSocket\Client;

class WebRconClass
{
    public const LAST_INDEX = 1001;

    /**
     * @var Client
     */
    private Client $client;

    private Logger $logger;

    private bool $debug = false;

    public function __construct(bool $debug = false)
    {
        if ($debug) {
            $this->debug = true;
            $this->logger = new Logger('player_manager');
            $this->logger->pushHandler(new BrowserConsoleHandler());
        }
    }

    /**
     * @param string $ip
     * @param int $port
     * @param string $password
     * @return void
     */
    public function connect(string $ip, int $port, string $password = "CHANGEME"): void
    {
        $this->client = new Client("ws://$ip:$port/$password");
    }

    /**
     * @param string $command
     * @param int $identifier
     * @return void
     */
    public function send(string $command, int $identifier = self::LAST_INDEX): void
    {
        /**
         * The library used require to send a text message to connect to websocket instead
         */
        //        if (! $this->client->isConnected()) {
        //            return;
        //        }

        if ($identifier == null) {
            $identifier = -1;
        }

        $this->client->text(json_encode([
            'Identifier' => $identifier,
            'Message' => $command,
            'Name' => "WebRcon",
        ]));

        if ($this->debug) {
            $this->logger->debug("running $command on ".$this->client->getRemoteName());
        }
    }

    /**
     * @return ?array
     */
    public function receive(): ?array
    {
        $response = json_decode($this->client->receive(), true);
        // decode the message as json or the original text if json decode failed
        $response['Message'] = json_decode($response['Message']) ?? $response['Message'];

        if ($this->debug) {
            $this->logger->debug('Response', [$response]);
        }

        return $response;
    }

    public function isConnected(): bool
    {
        return $this->client->isConnected();
    }
}
