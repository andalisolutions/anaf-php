<?php

use Anaf\Responses\Ngo\CreateResponse;
use Anaf\Responses\Ngo\CreateResponses;

test('create', function () {
    $client = mockClient('POST', '/RegCult/api/v2/ws/cult', getNgoAnafInfo());

    $result = $client->ngo()->create([
        [
            'cui' => '12345678',
            'data' => '2023-01-01',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class);

    expect($result->entityName)
        ->toBe('ASOCIATIA TEST');
});

test('create for multiple Ngos', function () {
    $client = mockClient('POST', '/RegCult/api/v2/ws/cult', getMultipleNgoAnafInfo());

    $result = $client->ngo()->create([
        [
            'cui' => '12345678',
            'data' => '2023-01-01',
        ],
        [
            'cui' => '87654321',
            'data' => '2023-01-01',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponses::class)
        ->and($result->responses)->toHaveCount(2)
        ->and($result->responses[0])->toBeInstanceOf(CreateResponse::class)
        ->and($result->responses[1])->toBeInstanceOf(CreateResponse::class)
        ->and($result->responses[0]->entityName)->toBe('ASOCIATIA TEST');
});
