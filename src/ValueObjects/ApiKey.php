<?php

declare(strict_types=1);

namespace Anaf\ValueObjects;

use Anaf\Contracts\StringableContract;

/**
 * @internal
 */
class ApiKey implements StringableContract
{
    /**
     * Creates a new API Token value object.
     */
    private function __construct(private readonly string $apiKey)
    {
        // ..
    }

    public static function from(string $apiKey): self
    {
        return new self($apiKey);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->apiKey;
    }
}
