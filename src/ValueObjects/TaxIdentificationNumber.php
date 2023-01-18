<?php

declare(strict_types=1);

namespace Anaf\ValueObjects;

use Anaf\Contracts\Stringable;

/**
 * @internal
 */
final class TaxIdentificationNumber implements Stringable
{
    /**
     * Creates a new tax identification number value object.
     */
    private function __construct(private readonly string $taxIndentificationNumber)
    {
        // ..
    }

    public static function from(string $taxIndentificationNumber): self
    {
        $cleanTaxIdentificationNumber = str_replace('RO', '', strtoupper(trim($taxIndentificationNumber)));

        return new self($cleanTaxIdentificationNumber);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->taxIndentificationNumber;
    }
}
