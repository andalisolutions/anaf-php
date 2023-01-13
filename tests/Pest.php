<?php

use Anaf\Client;
use Anaf\Contracts\Transporter;
use Anaf\Enums\Transporter\ContentType;
use Anaf\ValueObjects\TaxIdentificationNumber;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\Payload;

function mockClient(string $method, string $resource, array $params, array|string $response, $methodName = 'requestObject')
{
    $transporter = Mockery::mock(Transporter::class);
    $taxIdentificationNumber = TaxIdentificationNumber::from(38744563);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('webservicesp.anaf.ro');
            $headers = Headers::withContentType(ContentType::JSON);

            $request = $payload->toRequest($baseUri, $headers);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === "/$resource";
        })->andReturn($response);

    return new Client($transporter, $taxIdentificationNumber);
}

function mockContentClient(string $method, string $resource, array $params, string $response)
{
    return mockClient($method, $resource, $params, $response, 'requestContent');
}
