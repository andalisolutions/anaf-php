<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Responses\Ong\GetResponse;
use Anaf\ValueObjects\Transporter\Payload;

final class Ong
{
    use Concerns\Transportable;

    /**
     * Get public info about the given tax identification number if are registered in the Register of religious entities/units
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html
     */
    public function get(): GetResponse
    {
        $parameters = [
            [
                'cui' => $this->taxIdentificationNumber->toString(),
                'data' => date('Y-m-d'),
            ],
        ];

        $payload = Payload::create('RegCult/api/v2/ws/cult', $parameters);

        /**
         * @var array{cod: int, message: string, found: array<int, array{cui: int, data: string, denumire: string, adresa: string, nrRegCom: string, telefon: string, fax: string, codPostal: string, act: string, stare_inregistrare: string, dataInceputRegCult: string, dataAnulareRegCult: string, statusRegCult: bool}>, notFound: array<int,string>} $result
         */
        $result = $this->transporter->requestObject($payload);

        return GetResponse::from($result['found'][0]);
    }
}
