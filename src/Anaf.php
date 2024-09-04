<?php

declare(strict_types=1);

use Anaf\Client;
use Anaf\Factory;

class Anaf
{
    /**
     * Creates a new Anaf Authorized Client with the given api key.
     */
    public static function authorizedClient(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withBaseUri('api.anaf.ro')
            ->make();
    }

    /**
     * Creates a new Anaf Client for non-authorized requests.
     */
    public static function client(): Client
    {
        return self::factory()
            ->withBaseUri('webservicesp.anaf.ro')
            ->make();
    }

    /**
     * Creates a new factory instance to configure a custom ANAF Client
     */
    public static function factory(): Factory
    {
        return new Factory;
    }
}
