<?php

use Anaf\Responses\BalanceSheet\GetResponse;

test('balance from anaf', function () {
    $response = GetResponse::from(getAnafBalanceSheet());
    expect($response)
        ->toBeInstanceOf(GetResponse::class)
        ->taxIdentificationNumber->toBe(38744563)
            ->companyName->toBe('ANDALI SOLUTIONS PRO SRL')
            ->activityCode->toBe(6201)
            ->indicators->toBeArray()->toHaveCount(20);
});

test('to array', function () {
    $response = GetResponse::from(getAnafBalanceSheet());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(getBalanceSheet());
});

test('as array accessible', function () {
    $response = GetResponse::from(getAnafBalanceSheet());

    expect($response['company_name'])->toBe('ANDALI SOLUTIONS PRO SRL');
});
