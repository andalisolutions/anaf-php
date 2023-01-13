<?php

use Anaf\Client;

it('may create a client', function () {
    $anafClient = Anaf::for('38744563');

    expect($anafClient)->toBeInstanceOf(Client::class);
});
