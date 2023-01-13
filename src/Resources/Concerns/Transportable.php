<?php

declare(strict_types=1);

namespace Anaf\Resources\Concerns;

use Anaf\Contracts\Transporter;
use Anaf\ValueObjects\TaxIdentificationNumber;

trait Transportable
{
    /**
     * Creates a Client instance with the given Tax Identification Number.
     */
    public function __construct(private readonly Transporter $transporter, private readonly TaxIdentificationNumber $taxIdentificationNumber)
    {
        // ..
    }
}
