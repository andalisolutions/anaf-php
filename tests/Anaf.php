<?php

use Anaf\Client;

it('may create a client', function () {
    $anafClient = Anaf::client();

    expect($anafClient)->toBeInstanceOf(Client::class);
});

it('may create a authorized client', function () {
    $anafClient = Anaf::authorizedClient('dummy-api-key');

    expect($anafClient)->toBeInstanceOf(Client::class);
});

it('may create a client via factory', function () {
    $anafClient = Anaf::factory()
        ->withApiKey('foo')
        ->make();

    expect($anafClient)->toBeInstanceOf(Client::class);
});
