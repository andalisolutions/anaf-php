<?php

use Anaf\Enums\Transporter\ContentType;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\Payload;

it('has a method', function () {
    $payload = Payload::create('PlatitorTvaRest/api/v8/ws/tva', []);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getMethod())->toBe('POST');
});

it('has a uri', function () {
    $payload = Payload::create('PlatitorTvaRest/api/v8/ws/tva', [[]]);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::withContentType(ContentType::JSON);

    $uri = $payload->toRequest($baseUri, $headers)->getUri();

    expect($uri->getHost())->toBe('webservicesp.anaf.ro')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/PlatitorTvaRest/api/v8/ws/tva');
});

test('post tax identification number has a body', function () {
    $payload = Payload::create('PlatitorTvaRest/api/v8/ws/tva', $parameters = [
        [
            'cui' => '3874563',
            'data' => date('Y-m-d'),
        ],
    ]);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe(json_encode([
        [
            'cui' => '3874563',
            'data' => date('Y-m-d'),
        ],
    ]));
});
