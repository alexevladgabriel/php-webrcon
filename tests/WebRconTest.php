<?php

use Scai\WebRcon\WebRconClass;

it('can send & receive commands', function () {
    $rcon = new WebRconClass('65.108.139.88', 28016, 'CHANGEME');
    $rcon->command('serverinfo');
    $data = $rcon->receive();

    expect($data['Hostname'])
        ->toEqual('A Rust Server');
    expect($data['Map'])
        ->toEqual('Procedural Map');
});
