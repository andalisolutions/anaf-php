<?php

declare(strict_types=1);

namespace Anaf\ValueObjects\Transporter;

use Anaf\Enums\Transporter\ContentType;
use Anaf\Enums\Transporter\Method;
use Anaf\ValueObjects\ResourceUri;
use Http\Discovery\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @internal
 */
class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<array-key, mixed>  $parameters
     */
    private function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = [],
        private readonly ?string $body = null,
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
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<array-key, string>  $parameters
     */
    public static function upload(string $resource, string $body, array $parameters = [], ContentType $contentType = ContentType::TEXT): self
    {
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters, $body);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<array-key, mixed>  $parameters
     */
    public static function get(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory();

        $uri = $baseUri->toString().$this->uri->toString();

        $queryParams = $queryParams->toArray();

        if ($this->method === Method::GET) {
            $queryParams = [...$queryParams, ...$this->parameters];
        }

        if ($queryParams !== []) {
            $uri .= '?'.http_build_query($queryParams);
        }

        $headers = $headers
            ->withContentType($this->contentType)
            ->acceptContentType($this->contentType);

        $body = match ($this->contentType) {
            ContentType::JSON => $this->method === Method::GET ? null : $psr17Factory->createStream(json_encode($this->parameters, JSON_THROW_ON_ERROR)),
            ContentType::TEXT, ContentType::ALL => $psr17Factory->createStream((string) $this->body),
        };

        $request = $psr17Factory->createRequest($this->method->value, $uri);

        if ($body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
