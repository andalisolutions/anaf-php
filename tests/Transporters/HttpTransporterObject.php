<?php

use Anaf\Enums\Transporter\ContentType;
use Anaf\Exceptions\TransporterException;
use Anaf\Exceptions\UnserializableResponse;
use Anaf\Transporters\HttpTransporter;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\Payload;
use Anaf\ValueObjects\Transporter\QueryParams;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('webservicesp.anaf.ro'),
        Headers::create()->withContentType(ContentType::JSON),
        QueryParams::create()->withParam('cui', '38744563')
    );
});

test('request object', function () {
    $payload = Payload::create('api/PlatitorTvaRest/v9/tva', []);

    $response = new Response(200, [], json_encode([
        'asdf',
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('POST')
                ->and($request->getUri())
                ->getHost()->toBe('webservicesp.anaf.ro')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/api/PlatitorTvaRest/v9/tva');

            return true;
        })->andReturn($response);

    $this->http->requestObject($payload);
});

test('request object from xml', function () {
    $payload = Payload::upload('prod/FCTEL/rest/upload', 'dummy xml content');

    $response = new Response(200, [
        'Content-Type' => 'application/xml',
    ], '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<header xmlns="mfp:anaf:dgti:spv:respUploadFisier:v1" dateResponse="202108051140" ExecutionStatus="0" index_incarcare="3828"/>');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('POST')
                ->and($request->getUri())
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/prod/FCTEL/rest/upload');

            return true;
        })->andReturn($response);

    $this->http->requestObject($payload);
});

test('request object response', function () {
    $payload = Payload::create('api/PlatitorTvaRest/v9/tva', []);

    $response = new Response(200, [], json_encode(
        [
            'cod' => 200,
            'message' => 'SUCCESS',
            'found' => [
                [
                    'date_generale' => [
                        'cui' => 38744563,
                        'denumire' => 'ANDALI SOLUTIONS PRO S.R.L.',
                    ],
                ],
            ],
        ]
    ));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestObject($payload);

    expect($response)->toBe(
        [
            'cod' => 200,
            'message' => 'SUCCESS',
            'found' => [
                [
                    'date_generale' => [
                        'cui' => 38744563,
                        'denumire' => 'ANDALI SOLUTIONS PRO S.R.L.',
                    ],
                ],
            ],
        ]
    );
});

test('request object client errors', function () {
    $payload = Payload::create('api/PlatitorTvaRest/v9/tva', []);

    $baseUri = BaseUri::from('webservicesp.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create()->withParam('cui', '38744563');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers, $queryParams)));

    expect(fn () => $this->http->requestObject($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request object serialization errors', function () {
    $payload = Payload::create('api/PlatitorTvaRest/v9/tva', []);

    $response = new Response(200, [], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->requestObject($payload);
})->throws(UnserializableResponse::class, 'Syntax error');
