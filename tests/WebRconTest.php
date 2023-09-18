<?php


$rcon = new \Scai\WebRcon\WebRconClass(true);
$rcon->connect('192.168.1.100', 28017, 'CHANGEME');
it('connect successfully to server', function () use ($rcon) {
    try {
        $rcon->send('serverinfo');
    } catch (\WebSocket\ConnectionException $exception) {
    }
    expect($rcon->isConnected())->toBeTrue();
});

it('can receive commands', function () use ($rcon) {
    $rcon->send('serverinfo');
    $rcon->receive();
    expect($rcon->receive())->toBeArray();
    $rcon->send('status');
    $rcon->receive();
    expect($rcon->receive())->toBeArray();
})->depends('it connect successfully to server');
