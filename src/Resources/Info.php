<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Exceptions\TaxIdentificationNumberNotFoundException;
use Anaf\Exceptions\TransporterException;
use Anaf\Exceptions\UnserializableResponse;
use Anaf\Responses\Info\CreateResponse;
use Anaf\Responses\Info\CreateResponses;
use Anaf\ValueObjects\Transporter\Payload;
use InvalidArgumentException;

class Info
{
    use Concerns\Transportable;

    /**
     * Get public info about the given tax identification number
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V8.txt
     *
     * @param  list<array{cui: string, data: string}>  $parameters
     *
     * @throws TaxIdentificationNumberNotFoundException
     * @throws TransporterException
     * @throws UnserializableResponse
     */
    public function create(array $parameters): CreateResponse|CreateResponses
    {
        if (count($parameters) > 500) {
            throw new InvalidArgumentException('Maximum 500 companies allowed');
        }

        $payload = Payload::create('PlatitorTvaRest/api/v8/ws/tva', $parameters);

        /**
         * @var array{cod: int, message: string, found: array<int, array{date_generale: array{cui: int, data: string, denumire: string, adresa: string, nrRegCom: string, telefon: string, fax: string, codPostal: string, act: string, stare_inregistrare: string, data_inregistrare: string, cod_CAEN: string, iban: string, statusRO_e_Factura: bool, organFiscalCompetent: string, forma_de_proprietate: string, forma_organizare: string, forma_juridica: string}, inregistrare_scop_Tva: array{scpTVA: bool, perioade_TVA: array<int, array{data_inceput_ScpTVA: ?string, data_sfarsit_ScpTVA: ?string, data_anul_imp_ScpTVA: ?string, mesaj_ScpTVA: ?string}>}, inregistrare_RTVAI: array{dataInceputTvaInc: string, dataSfarsitTvaInc: string, dataActualizareTvaInc: string, dataPublicareTvaInc: string, tipActTvaInc: string, statusTvaIncasare: bool}, stare_inactiv: array{dataInactivare: string, dataReactivare: string, dataPublicare: string, dataRadiere: string, statusInactivi: bool}, inregistrare_SplitTVA: array{dataInceputSplitTVA: string, dataAnulareSplitTVA: string, statusSplitTVA: bool}, adresa_sediu_social: array{sdenumire_Strada: string, snumar_Strada: string, sdenumire_Localitate: string, scod_Localitate: string, sdenumire_Judet: string, scod_Judet: string, scod_JudetAuto: string, stara: string, sdetalii_Adresa: string, scod_Postal: string}, adresa_domiciliu_fiscal: array{ddenumire_Strada: string, dnumar_Strada: string, ddenumire_Localitate: string, dcod_Localitate: string, ddenumire_Judet: string, dcod_Judet: string, dcod_JudetAuto: string, dtara: string, ddetalii_Adresa: string, dcod_Postal: string}}>, notFound: array<int,string>} $response
         */
        $response = $this->transporter->requestObject($payload);

        if ($response['found'] === []) {
            throw new TaxIdentificationNumberNotFoundException();
        }

        if (count($response['found']) > 1) {
            return CreateResponses::from($response['found']);
        }

        return CreateResponse::from($response['found'][0]);
    }
}
