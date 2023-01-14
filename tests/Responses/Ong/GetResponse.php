<?php

use Anaf\Responses\Ong\GetResponse;

test('from anaf', function () {
    $response = GetResponse::from(getOngAnafInfo()['found'][0]);
    expect($response)
        ->toBeInstanceOf(GetResponse::class)
        ->taxIdentificationNumber->toBe(123446)
            ->searchDate->toBe(date('Y-m-d'))
            ->entityName->toBe('ASOCIATIA TEST')
            ->address->toBe('Campulung')
            ->phone->toBe('0700000000')
            ->postalCode->toBe('115100')
            ->document->toBe('DOSAR 1/1/2023')
            ->registrationStatus->toBe('INREGISTRAT din data 14.01.2023')
            ->startDate->toBe('2023-01-14')
            ->endDate->toBe(' ')
            ->status->toBe(true);
});

test('to array', function () {
    $response = GetResponse::from(getOngAnafInfo()['found'][0]);

    expect($response->toArray())
        ->toBeArray()
        ->toBe(getOngInfo());
});

test('as array accessible', function () {
    $response = GetResponse::from(getOngAnafInfo()['found'][0]);

    expect($response['entity_name'])->toBe('ASOCIATIA TEST');
});
