<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Responses\Ngo\CreateResponse;
use Anaf\Responses\Ngo\CreateResponses;
use Anaf\ValueObjects\Transporter\Payload;

class Ngo
{
    use Concerns\Transportable;

    /**
     * Get public info about the given tax identification number if are registered in the Register of religious entities/units
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html
     *
     * @param  list<array{cui: string, data: string}>  $parameters
     */
    public function create(array $parameters): CreateResponse|CreateResponses
    {
        $payload = Payload::create('RegCult/api/v2/ws/cult', $parameters);

        /**
         * @var array{cod: int, message: string, found: array<int, array{cui: int, data: string, denumire: string, adresa: string, nrRegCom: string, telefon: string, fax: string, codPostal: string, act: string, stare_inregistrare: string, dataInceputRegCult: string, dataAnulareRegCult: string, statusRegCult: bool}>, notFound: array<int,string>} $response
         */
        $response = $this->transporter->requestObject($payload);

        if (count($response['found']) > 1) {
            return CreateResponses::from($response['found']);
        }

        return CreateResponse::from($response['found'][0]);
    }
}
