<?php

declare(strict_types=1);

namespace Anaf\Resources\Concerns;

use Anaf\Contracts\TransporterContract;

trait Transportable
{
    /**
     * Creates a Client instance with the given Tax Identification Number.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }
}
