<?php

declare(strict_types=1);

namespace Anaf\ValueObjects\Transporter;

use Anaf\Enums\Transporter\ContentType;
use Anaf\Enums\Transporter\Method;
use Anaf\ValueObjects\ResourceUri;
use GuzzleHttp\Psr7\Request as Psr7Request;

/**
 * @internal
 */
final class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<int, array{cui: string, data: string}>  $parameters
     */
    private function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = [],
    ) {
        // ..
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<int, array{cui: string, data: string}>  $parameters
     */
    public static function create(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::retreiveInfo($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers): Psr7Request
    {
        $body = null;
        $uri = $baseUri->toString().$this->uri->toString();

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            $body = json_encode($this->parameters, JSON_THROW_ON_ERROR);
        }

        return new Psr7Request($this->method->value, $uri, $headers->toArray(), $body);
    }
}
