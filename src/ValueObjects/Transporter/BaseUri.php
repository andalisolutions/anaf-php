<?php

declare(strict_types=1);

namespace Anaf\ValueObjects\Transporter;

use Anaf\Contracts\StringableContract;

/**
 * @internal
 */
class BaseUri implements StringableContract
{
    /**
     * Creates a new Base URI value object.
     */
    private function __construct(
        private readonly string $baseUri,
        private readonly bool $staging,
    ) {
        // ..
    }

    /**
     * Creates a new Base URI value object.
     */
    public static function from(string $baseUri, bool $staging = false): self
    {
        return new self($baseUri, $staging);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        foreach (['http://', 'https://'] as $protocol) {
            if (str_starts_with($this->baseUri, $protocol)) {
                return $this->setStaging($this->baseUri);
            }
        }

        return $this->setStaging("https://{$this->baseUri}");
    }

    /**
     * Sets the staging environment.
     */
    private function setStaging(string $baseUri): string
    {
        // check if base url contains prod string and replace with test if staging is true
        if ($this->staging) {
            $baseUri = str_replace('/prod/', '/test/', $baseUri);
        }

        return $baseUri.'/';
    }
}
