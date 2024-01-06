<?php

use Anaf\Enums\Transporter\ContentType;
use Anaf\ValueObjects\ApiKey;
use Anaf\ValueObjects\Transporter\Headers;

it('can be created from an API Token', function () {
    $headers = Headers::withAuthorization(ApiKey::from('dummy-api-key'));

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer dummy-api-key',
    ]);
});

it('can have content/type', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
    ]);
});

it('can have accept content/type', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON)
        ->acceptContentType(ContentType::ALL);

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
        'Accept' => '*/*',
    ]);
});
