<?php

declare(strict_types=1);

use Anaf\Client;
use Anaf\Factory;

class Anaf
{
    /**
     * Creates a new Anaf Authorized Client with the given api key.
     */
    public static function authorizedClient(string $apiKey, bool $isStage = false): Client
    {
        $factory = self::factory()
            ->withApiKey($apiKey)
            ->withBaseUri('api.anaf.ro');

        if (! $isStage) {
            return $factory->make();
        }

        return $factory->staging()->make();
    }

    /**
     * Creates a new Anaf Client for non-authorized requests.
     */
    public static function client(bool $isStage = false): Client
    {
        $factory = self::factory()
            ->withBaseUri('webservicesp.anaf.ro');

        if (! $isStage) {
            return $factory->make();
        }

        return $factory->staging()->make();
    }

    /**
     * Creates a new factory instance to configure a custom ANAF Client
     */
    public static function factory(): Factory
    {
        return new Factory;
    }
}
