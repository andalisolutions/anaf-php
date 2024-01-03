<?php

use Anaf\Resources\BalanceSheet;
use Anaf\Resources\Efactura;
use Anaf\Resources\Info;
use Anaf\Resources\Ngo;

it('has info', function () {
    $client = Anaf::client();

    expect($client->info())->toBeInstanceOf(Info::class);
});

it('has ngo', function () {
    $client = Anaf::client();

    expect($client->ngo())->toBeInstanceOf(Ngo::class);
});

it('has balance sheet', function () {
    $client = Anaf::client();

    expect($client->balanceSheet())->toBeInstanceOf(BalanceSheet::class);
});

it('has spv', function () {
    $client = Anaf::client();

    expect($client->efactura())->toBeInstanceOf(Efactura::class);
});
