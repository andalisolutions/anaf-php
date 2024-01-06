<?php

use Anaf\Client;
use Anaf\Contracts\FileContract;
use Anaf\Contracts\Response;
use Anaf\Contracts\TransporterContract;
use Anaf\ValueObjects\ApiKey;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\Payload;
use Anaf\ValueObjects\Transporter\QueryParams;
use Psr\Http\Message\ResponseInterface;

function mockClient(string $method, string $resource, Response|ResponseInterface|string|array $response, $methodName = 'requestObject')
{
    $transporter = Mockery::mock(TransporterContract::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('webservicesp.anaf.ro');
            $headers = Headers::create();
            $queryParams = QueryParams::create();

            $request = $payload->toRequest($baseUri, $headers, $queryParams);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === $resource;
        })->andReturn($response);

    return new Client($transporter);
}

function mockAuthorizedClient(string $method, string $resource, Response|ResponseInterface|FileContract|string|array $response, $methodName = 'requestObject')
{
    $transporter = Mockery::mock(TransporterContract::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('api.anaf.ro');
            $headers = Headers::withAuthorization(ApiKey::from('foo'));
            $queryParams = QueryParams::create();

            $request = $payload->toRequest($baseUri, $headers, $queryParams);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === $resource;
        })->andReturn($response);

    return new Client($transporter);
}
