<?php

use Anaf\Responses\Ong\GetResponse;

test('get ong', function () {
    $client = mockClient('POST', 'RegCult/api/v2/ws/cult', [], getOngAnafInfo());

    $result = $client->ngo()->get();

    expect($result)
        ->toBeInstanceOf(GetResponse::class);

    expect($result->entityName)
        ->toBe('ASOCIATIA TEST');
});
