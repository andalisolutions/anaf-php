<?php

use Anaf\Responses\BalanceSheet\CreateResponse;

test('get balance sheet', function () {
    $client = mockClient('GET', '/bilant', getAnafBalanceSheet());

    $result = $client->balanceSheet()->create([
        'cui' => '123456',
        'an' => '2021',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class);

    expect($result->activityCode)
        ->toBe(6201);
});
