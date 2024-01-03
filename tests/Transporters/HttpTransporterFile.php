<?php

use Anaf\Enums\Transporter\ContentType;
use Anaf\Exceptions\FileTypeException;
use Anaf\Exceptions\TransporterException;
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
        BaseUri::from('api.anaf.ro'),
        Headers::create()->withContentType(ContentType::JSON),
        QueryParams::create()
    );
});

test('request file', function () {
    $payload = Payload::get('prod/FCTEL/rest/descarcare', [
        'id' => '123',
    ]);

    $response = new Response(200, [
        'Content-Type' => 'application/pdf',
    ], 'file');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('GET')
                ->and($request->getUri())
                ->getHost()->toBe('api.anaf.ro')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/prod/FCTEL/rest/descarcare');

            return true;
        })->andReturn($response);

    $this->http->requestFile($payload);
});

test('file type exception', function () {
    $payload = Payload::get('prod/FCTEL/rest/descarcare', [
        'id' => '123',
    ]);

    $response = new Response(200, [
        'Content-Type' => 'application/json',
    ], json_encode([]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestFile($payload))
        ->toThrow(function (FileTypeException $e) {
            expect($e->getMessage())->toBe('File type not allowed for saving or downloading.');
        });
});

test('request file client errors', function () {
    $payload = Payload::get('prod/FCTEL/rest/descarcare', []);

    $baseUri = BaseUri::from('api.anaf.ro');
    $headers = Headers::create()->withContentType(ContentType::TEXT);
    $queryParams = QueryParams::create()->withParam('id', '123');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers, $queryParams)));

    expect(fn () => $this->http->requestFile($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});
