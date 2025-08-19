<?php

use Anaf\Enums\Transporter\ContentType;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\Payload;
use Anaf\ValueObjects\Transporter\QueryParams;

it('has a post method', function () {
    $payload = Payload::create('api/PlatitorTvaRest/v9/tva', []);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getMethod())->toBe('POST');
});

it('has a get method', function () {
    $payload = Payload::get('bilant', []);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create()
        ->withParam('cui', '3874563')
        ->withParam('data', date('Y-m-d'));

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getMethod())->toBe('GET');
});

it('has a uri', function () {
    $payload = Payload::get('bilant', [[]]);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create()
        ->withParam('cui', '3874563')
        ->withParam('data', '2023-01-01');

    $uri = $payload->toRequest($baseUri, $headers, $queryParams)->getUri();

    expect($uri->getHost())->toBe('webservicesp.anaf.ro')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/bilant')
        ->and($uri->getQuery())->toBe('cui=3874563&data=2023-01-01');
});

test('get verb does not have a body', function () {
    $payload = Payload::get('bilant', [[]]);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe('');
});

test('post verb has a body', function () {
    $payload = Payload::create('api/PlatitorTvaRest/v9/tva', [
        [
            'cui' => '3874563',
            'data' => '2023-01-01',
        ],
    ]);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::JSON);

    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe(json_encode([
        [
            'cui' => '3874563',
            'data' => '2023-01-01',
        ],
    ]));
});
