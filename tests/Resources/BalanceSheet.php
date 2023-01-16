<?php

use Anaf\Responses\BalanceSheet\GetResponse;

test('get balance sheet', function () {
    $client = mockClient('GET', 'bilant', [], getAnafBalanceSheet());

    $result = $client->balanceSheet()->forYear('2021');

    expect($result)
        ->toBeInstanceOf(GetResponse::class);

    expect($result->activityCode)
        ->toBe(6201);
});
