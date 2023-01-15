<?php

use Anaf\Responses\Ngo\GetResponse;

test('get ong', function () {
    $client = mockClient('POST', 'RegCult/api/v2/ws/cult', [], getNgoAnafInfo());

    $result = $client->ngo()->get();

    expect($result)
        ->toBeInstanceOf(GetResponse::class);

    expect($result->entityName)
        ->toBe('ASOCIATIA TEST');
});
