<?php

use Anaf\Responses\Info\CreateResponse;
use Anaf\Responses\Info\CreateResponses;
use Anaf\Responses\Info\RetrieveResponseFiscalAddress;
use Anaf\Responses\Info\RetrieveResponseGeneralData;
use Anaf\Responses\Info\RetrieveResponseHqAddress;
use Anaf\Responses\Info\RetrieveResponseInactiveState;
use Anaf\Responses\Info\RetrieveResponseSplitVatRegistration;
use Anaf\Responses\Info\RetrieveResponseVatRegistration;
use Anaf\Responses\Info\RetrieveResponseVatRegistrationAtCheckout;

test('from anaf', function () {
    $response = CreateResponse::from(getCompanyAnafInfo()['found'][0]);
    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->generalData->toBeInstanceOf(RetrieveResponseGeneralData::class)
        ->vatRegistration->toBeInstanceOf(RetrieveResponseVatRegistration::class)
        ->vatAtCheckout->toBeInstanceOf(RetrieveResponseVatRegistrationAtCheckout::class)
        ->inactiveState->toBeInstanceOf(RetrieveResponseInactiveState::class)
        ->splitVat->toBeInstanceOf(RetrieveResponseSplitVatRegistration::class)
        ->hqAddress->toBeInstanceOf(RetrieveResponseHqAddress::class)
        ->fiscalAddress->toBeInstanceOf(RetrieveResponseFiscalAddress::class);
});

test('from anaf with multiple companies', function () {
    $responses = CreateResponses::from(getMultipleCompanyAnafInfo()['found']);
    expect($responses)
        ->toBeInstanceOf(CreateResponses::class)
        ->responses->toBeArray()
        ->each->toBeInstanceOf(CreateResponse::class);
});

test('to array', function () {
    $response = CreateResponse::from(getCompanyAnafInfo()['found'][0]);

    expect($response->toArray())
        ->toBeArray()
        ->toBe(getCompanyInfo());
});

test('as array accessible', function () {
    $response = CreateResponse::from(getCompanyAnafInfo()['found'][0]);

    expect($response['general_data']['company_name'])->toBe('ANDALI SOLUTIONS PRO S.R.L.');
});
