<?php

declare(strict_types=1);

namespace Anaf\ValueObjects;

use Anaf\Contracts\StringableContract;

/**
 * @internal
 */
class ResourceUri implements StringableContract
{
    /**
     * Creates a new ResourceUri value object.
     */
    private function __construct(private readonly string $uri)
    {
        // ..
    }

    /**
     * Creates a new ResourceUri value object that creates the given resource.
     */
    public static function create(string $resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that retrieves the given resource content.
     */
    public static function get(string $resource): self
    {
        return new self($resource);
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->uri;
    }
}
