<?php

declare(strict_types=1);

namespace Anaf;

use Anaf\Transporters\HttpTransporter;
use Anaf\ValueObjects\ApiKey;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use Anaf\ValueObjects\Transporter\QueryParams;
use GuzzleHttp\Client as GuzzleClient;

class Factory
{
    /**
     * The Bear token for the requests.
     */
    private ?string $apiKey = null;

    /**
     * The base URI for the requests.
     */
    private ?string $baseUri = null;

    private static bool $staging = false;

    /**
     * The query parameters for the requests.
     *
     * @var array<string, string|int>
     */
    private array $queryParams = [];

    /**
     * Sets the Token for the requests.
     */
    public function withApiKey(string $token): self
    {
        $this->apiKey = $token;

        return $this;
    }

    /**
     * Sets the base URI for the requests.
     * If no URI is provided the factory will use the default ANAF API URI.
     */
    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Sets the staging mode for the requests.
     */
    public function staging(): self
    {
        self::$staging = true;

        return $this;
    }

    public static function isStaging(): bool
    {
        return self::$staging;
    }

    /**
     * Adds a custom query parameter to the request url.
     */
    public function withQueryParam(string $name, string $value): self
    {
        $this->queryParams[$name] = $value;

        return $this;
    }

    /**
     * Creates a new ANAF Client.
     */
    public function make(): Client
    {
        $headers = Headers::create();

        if ($this->apiKey !== null) {
            $headers = Headers::withAuthorization(ApiKey::from($this->apiKey));
        }

        $baseUri = BaseUri::from($this->baseUri ?: 'webservicesp.anaf.ro');

        $queryParams = QueryParams::create();

        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }

        $client = new GuzzleClient();

        $transporter = new HttpTransporter($client, $baseUri, $headers, $queryParams);

        return new Client($transporter);
    }
}
