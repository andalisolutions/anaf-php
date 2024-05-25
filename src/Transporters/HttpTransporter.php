<?php

declare(strict_types=1);

namespace Anaf\Transporters;

use Anaf\Contracts\TransporterContract;
use Anaf\Exceptions\FileTypeException;
use Anaf\Exceptions\TransporterException;
use Anaf\Exceptions\UnserializableResponse;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\FileHandler;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\Payload;
use Anaf\ValueObjects\Transporter\QueryParams;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

/**
 * @internal
 */
class HttpTransporter implements TransporterContract
{
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        private readonly ClientInterface $client,
        private readonly BaseUri $baseUri,
        private readonly Headers $headers,
        private readonly QueryParams $queryParams,
    ) {
        // ..
    }

    /**
     * {@inheritDoc}
     *
     * @throws JsonException
     */
    public function requestObject(Payload $payload): array
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        try {
            $response = $this->client->sendRequest($request);

        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = $response->getBody()->getContents();

        try {
            /** @var array<array-key, mixed> $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        } catch (JsonException $jsonException) {

            $xml = simplexml_load_string($contents, 'SimpleXMLElement', LIBXML_NOCDATA);

            if ($xml === false) {
                throw new UnserializableResponse($jsonException);
            }

            try {
                $jsonResponse = json_encode($xml, JSON_THROW_ON_ERROR);

            } catch (JsonException $jsonException) {
                throw new UnserializableResponse($jsonException);
            }

            /** @var array<array-key, mixed> $response */
            $response = json_decode($jsonResponse, true, 512, JSON_THROW_ON_ERROR);

        }

        return $response;
    }

    public function requestFile(Payload $payload): FileHandler
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        try {
            $response = $this->client->sendRequest($request);

        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        if (! in_array($response->getHeaderLine('Content-Type'), ['application/zip', 'application/pdf'])) {
            throw new FileTypeException();
        }

        $fileContent = $response->getBody()->getContents();

        return new FileHandler($fileContent);
    }
}
