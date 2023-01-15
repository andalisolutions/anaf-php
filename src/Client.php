<?php

declare(strict_types=1);

namespace Anaf;

use Anaf\Contracts\Transporter;
use Anaf\Resources\Info;
use Anaf\Resources\Ngo;
use Anaf\ValueObjects\TaxIdentificationNumber;

final class Client
{
    /**
     * Creates a Client instance with the given Tax Identification Number.
     */
    public function __construct(private readonly Transporter $transporter, private readonly TaxIdentificationNumber $taxIdentificationNumber)
    {
        // ..
    }

    /**
     * Web service for checking taxpayers who are registered according to art. 316 of the Fiscal Code, according to the Register of taxable persons who apply the VAT system upon receipt,
     * according to the Register of inactive/reactive taxpayers, according to the Register of persons who apply the broken down payment of VAT and respectively the RO e-Invoice Register.
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V7.txt
     */
    public function info(): Info
    {
        return new Info($this->transporter, $this->taxIdentificationNumber);
    }

    /**
     * Verification of taxpayers who are registered in the Register of religious entities/units
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html
     */
    public function ngo(): Ngo
    {
        return new Ngo($this->transporter, $this->taxIdentificationNumber);
    }
}
