<?php

use Anaf\Responses\Info\CreateResponse;
use Anaf\Responses\Info\CreateResponses;

test('create', function () {
    $client = mockClient('POST', '/api/PlatitorTvaRest/v9/tva', getCompanyAnafInfo());

    $result = $client->info()->create([
        [
            'cui' => '31724556',
            'data' => '2021-10-01',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->and($result->generalData->companyName)
        ->toBe('ANDALI SOLUTIONS PRO S.R.L.');

});

test('create for multiple companies', function () {
    $client = mockClient('POST', '/api/PlatitorTvaRest/v9/tva', getMultipleCompanyAnafInfo());

    $results = $client->info()->create([
        [
            'cui' => '31724556',
            'data' => '2021-10-01',
        ],
        [
            'cui' => '123456789',
            'data' => '2021-10-01',
        ],
    ]);

    expect($results)
        ->toBeInstanceOf(CreateResponses::class)
        ->and($results->responses)->toHaveCount(2)
        ->and($results->responses[0])->toBeInstanceOf(CreateResponse::class)
        ->and($results->responses[1])->toBeInstanceOf(CreateResponse::class)
        ->and($results->responses[0]->generalData->companyName)->toBe('ANDALI SOLUTIONS PRO S.R.L.')
        ->and($results->responses[1]->generalData->companyName)->toBe('TEST S.R.L.');

});
