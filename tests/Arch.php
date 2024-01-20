<?php

test('contracts')
    ->expect('Anaf\Contracts')
    ->toOnlyUse([
        'Anaf\ValueObjects',
        'Anaf\Exceptions',
        'Psr\Http\Message\ResponseInterface',
    ])->toBeInterfaces();

test('exceptions')->expect('Anaf\Exceptions')->toOnlyUse([
    'Psr\Http\Client',
]);

test('resources')->expect('Anaf\Resources')->toOnlyUse([
    'Anaf\Contracts',
    'Anaf\ValueObjects',
    'Anaf\Exceptions',
    'Anaf\Responses',
    'Anaf\Enums',
]);

test('responses')->expect('Anaf\Responses')->toOnlyUse([
    'Anaf\Enums',
    'Anaf\Contracts',
]);

test('value objects')->expect('Anaf\ValueObjects')->toOnlyUse([
    'Anaf\Contracts',
    'Anaf\Enums',
    'Anaf\Factory',
    'Psr\Http\Message\RequestInterface',
    'Http\Discovery\Psr17Factory',
    'Psr\Http\Message\StreamInterface',
]);

test('client')->expect('Anaf\Client')->toOnlyUse([
    'Anaf\Resources',
    'Anaf\Contracts',
]);

test('anaf')->expect('Anaf')->toOnlyUse([
    'Psr\Http\Client',
    'GuzzleHttp\Client',
    'GuzzleHttp\Psr7',
    'Anaf\Resources',
    'Anaf\Contracts',
    'Http\Discovery\Psr17Factory',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\StreamInterface',
]);
