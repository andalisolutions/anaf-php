<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Responses\BalanceSheet\CreateResponse;
use Anaf\ValueObjects\Transporter\Payload;

class BalanceSheet
{
    use Concerns\Transportable;

    /**
     * Web service for obtaining public information from the financial
     * statements/annual accounting reports of economic agents
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/doc_WS_Bilant_V1.txt
     *
     * @param  array{cui: string, an: string}  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::get('bilant', $parameters);

        /**
         * @var array{an: int, cui: int, deni: string, caen: int, den_caen: string, i: array<int, array{indicator: string, val_indicator: int, val_den_indicator: string}>} $result
         */
        $result = $this->transporter->requestObject($payload);

        return CreateResponse::from($result);
    }
}
