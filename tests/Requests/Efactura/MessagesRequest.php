<?php

use Anaf\Enums\Efactura\MessagesFilter;
use Anaf\Requests\Efactura\MessagesRequest;

it('can be created ', function () {
    $messagesRequest = MessagesRequest::withTaxIdetificationNumber('8000000000')
        ->withDays(30);

    expect($messagesRequest->toArray())->toBe([
        'cif' => '8000000000',
        'zile' => '30',
    ]);
});

it('can be created for with filters', function () {
    $messagesRequest = MessagesRequest::withTaxIdetificationNumber('8000000000')
        ->withDays(30)
        ->withFilter(MessagesFilter::ERROR);

    expect($messagesRequest->toArray())->toBe([
        'cif' => '8000000000',
        'zile' => '30',
        'filtru' => 'E',
    ]);
});

it('can throw exception when days is not set', function () {
    $messagesRequest = MessagesRequest::withTaxIdetificationNumber('8000000000');

    $messagesRequest->toArray();
})->throws(InvalidArgumentException::class);

it('can throw exception when days is not between 1 and 60', function () {
    $messagesRequest = MessagesRequest::withTaxIdetificationNumber('8000000000')
        ->withDays(61);

    $messagesRequest->toArray();
})->throws(InvalidArgumentException::class);
