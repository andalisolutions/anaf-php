<?php

use Anaf\Client;

it('may create a client on stage and a client on prod', function () {
    $anafClientStage = Anaf::client(isStage: true);
    $anafClientProd = Anaf::client();

    expect($anafClientStage)->toBeInstanceOf(Client::class)
        ->and($anafClientProd)->toBeInstanceOf(Client::class);

    checkStageValue($anafClientStage, true);
    checkStageValue($anafClientProd, false);

});

it('may create an authorized client on stage and an authorized client on prod', function () {
    $anafClientStage =  Anaf::authorizedClient('dummy-api-key', isStage: true);
    $anafClientProd =  Anaf::authorizedClient('dummy-api-key');

    expect($anafClientStage)->toBeInstanceOf(Client::class)
        ->and($anafClientProd)->toBeInstanceOf(Client::class);

    checkStageValue($anafClientStage, true);
    checkStageValue($anafClientProd, false);
});

it('may create an authorized on stage and a client on prod', function () {
    $anafClientStage =  Anaf::authorizedClient('dummy-api-key', isStage: true);
    $anafClientProd =  Anaf::client();

    expect($anafClientStage)->toBeInstanceOf(Client::class)
        ->and($anafClientProd)->toBeInstanceOf(Client::class);

    checkStageValue($anafClientStage, true);
    checkStageValue($anafClientProd, false);
});

it('may create a client on stage and an authorized on prod', function () {
    $anafClientStage = Anaf::client(isStage: true);
    $anafClientProd = Anaf::authorizedClient('dummy-api-key');

    expect($anafClientStage)->toBeInstanceOf(Client::class)
        ->and($anafClientProd)->toBeInstanceOf(Client::class);

    checkStageValue($anafClientStage, true);
    checkStageValue($anafClientProd, false);
});

it('may create a client on stage', function () {
    $anafClient = Anaf::client(isStage: true);

    expect($anafClient)->toBeInstanceOf(Client::class);
    checkStageValue($anafClient, true);
});

it('may create an authorized client on stage', function () {
    $anafClient = Anaf::authorizedClient('dummy-api-key', isStage: true);

    expect($anafClient)->toBeInstanceOf(Client::class);
    checkStageValue($anafClient, true);
});

it('may create a client', function () {
    $anafClient = Anaf::client();

    expect($anafClient)->toBeInstanceOf(Client::class);
    checkStageValue($anafClient, false);
});

it('may create an authorized client', function () {
    $anafClient = Anaf::authorizedClient('dummy-api-key');

    expect($anafClient)->toBeInstanceOf(Client::class);
    checkStageValue($anafClient, false);
});

it('may create a client via factory', function () {
    $anafClient = Anaf::factory()
        ->withApiKey('foo')
        ->make();

    expect($anafClient)->toBeInstanceOf(Client::class);
});

