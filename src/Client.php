<?php

declare(strict_types=1);

namespace Anaf;

use Anaf\Contracts\TransporterContract;
use Anaf\Resources\BalanceSheet;
use Anaf\Resources\Efactura;
use Anaf\Resources\Info;
use Anaf\Resources\Ngo;

class Client
{
    /**
     * Creates a Client instance with the given Tax Identification Number.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }

    /**
     * Web service for checking taxpayers who are registered according to art. 316 of the Fiscal Code, according to the Register of taxable persons who apply the VAT system upon receipt,
     * according to the Register of inactive/reactive taxpayers, according to the Register of persons who apply the broken down payment of VAT and respectively the RO e-Invoice Register.
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V8.txt
     */
    public function info(): Info
    {
        return new Info($this->transporter);
    }

    /**
     * Verification of taxpayers who are registered in the Register of religious entities/units
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html
     */
    public function ngo(): Ngo
    {
        return new Ngo($this->transporter);
    }

    /**
     * Web service for obtaining public information from the financial
     * statements/annual accounting reports of economic agents
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/doc_WS_Bilant_V1.txt
     */
    public function balanceSheet(): BalanceSheet
    {
        return new BalanceSheet($this->transporter);
    }

    /**
     * Web services to use the ANAF e-Invoice system
     *
     * @see https://mfinante.gov.ro/web/efactura/informatii-tehnice
     */
    public function efactura(): Efactura
    {
        return new Efactura($this->transporter);
    }
}
