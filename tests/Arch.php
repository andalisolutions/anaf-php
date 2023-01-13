<?php

test('contracts')->expect('Anaf\Contracts')->toOnlyUse([
    'Anaf\ValueObjects',
    'Anaf\Exceptions',
]);

test('exceptions')->expect('Anaf\Exceptions')->toOnlyUse([
    'Psr\Http\Client',
]);

test('resources')->expect('Anaf\Resources')->toOnlyUse([
    'Anaf\Contracts',
    'Anaf\ValueObjects',
    'Anaf\Exceptions',
    'Anaf\Responses',
]);

test('responses')->expect('Anaf\Responses')->toOnlyUse([
    'Anaf\Enums',
    'Anaf\Contracts',
]);

test('value objects')->expect('Anaf\ValueObjects')->toOnlyUse([
    'GuzzleHttp\Psr7',
    'Anaf\Enums',
    'Anaf\Contracts',
]);

test('client')->expect('Anaf\Client')->toOnlyUse([
    'Anaf\Resources',
    'Anaf\Contracts',
    'Anaf\ValueObjects\TaxIdentificationNumber',
]);

test('anaf')->expect('Anaf')->toOnlyUse([
    'Psr\Http\Client',
    'GuzzleHttp\Client',
    'GuzzleHttp\Psr7',
    'Anaf\Resources',
    'Anaf\Contracts',
]);
