<?php

use Anaf\Responses\Info\GetResponse;

test('get', function () {
    $client = mockClient('POST', 'PlatitorTvaRest/api/v8/ws/tva', [], getCompanyAnafInfo());

    $result = $client->info()->get();

    expect($result)
        ->toBeInstanceOf(GetResponse::class);

    expect($result->generalData->companyName)
        ->toBe('ANDALI SOLUTIONS PRO S.R.L.');
});
