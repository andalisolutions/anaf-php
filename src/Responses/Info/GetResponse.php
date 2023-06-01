<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{general_data: array{tax_identification_number: int, search_date: string, company_name: string, address: string, registration_number: string, phone: string, fax: string, postal_code: string, document: string, registration_status: string, registration_date: string, activity_code: string, bank_account: string, ro_invoice_status: bool, authority_name: string, form_of_ownership: string, organizational_form: string, legal_form: string}, vat_registration: array{status: bool, vat_periods: array<int, array{start_date: ?string, stop_date: ?string, stop_effective_date: ?string, message: ?string}>}, vat_at_checkout: array{start_date: string, stop_date: string, update_date: string, publish_date: string, updated_type: string}, inactive_state: array{inactivation_date: string, reactivation_date: string, publish_date: string, deletion_date: string, status: bool}, split_vat: array{start_date: string, stop_date: string, status: bool}, hq_address: array{street: string, no: string, city: string, city_code: string, county: string, county_code: string, county_short: string, country: string, details: string, postalCode: string}, fiscal_address: array{street: string, no: string, city: string, city_code: string, county: string, county_code: string, county_short: string, country: string, details: string, postalCode: string}}>
 */
final class GetResponse implements Response
{
    /**
     * @use ArrayAccessible<array{general_data: array{tax_identification_number: int, search_date: string, company_name: string, address: string, registration_number: string, phone: string, fax: string, postal_code: string, document: string, registration_status: string, registration_date: string, activity_code: string, bank_account: string, ro_invoice_status: bool, authority_name: string, form_of_ownership: string, organizational_form: string, legal_form: string}, vat_registration: array{status: bool, vat_periods: array<int, array{start_date: ?string, stop_date: ?string, stop_effective_date: ?string, message: ?string}>}, vat_at_checkout: array{start_date: string, stop_date: string, update_date: string, publish_date: string, updated_type: string}, inactive_state: array{inactivation_date: string, reactivation_date: string, publish_date: string, deletion_date: string, status: bool}, split_vat: array{start_date: string, stop_date: string, status: bool}, hq_address: array{street: string, no: string, city: string, city_code: string, county: string, county_code: string, county_short: string, country: string, details: string, postalCode: string}, fiscal_address: array{street: string, no: string, city: string, city_code: string, county: string, county_code: string, county_short: string, country: string, details: string, postalCode: string}}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly RetrieveResponseGeneralData $generalData,
        public readonly RetrieveResponseVatRegistration $vatRegistration,
        public readonly RetrieveResponseVatRegistrationAtCheckout $vatAtCheckout,
        public readonly RetrieveResponseInactiveState $inactiveState,
        public readonly RetrieveResponseSplitVatRegistration $splitVat,
        public readonly RetrieveResponseHqAddress $hqAddress,
        public readonly RetrieveResponseFiscalAddress $fiscalAddress,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{date_generale: array{cui: int, data: string, denumire: string, adresa: string, nrRegCom: string, telefon: string, fax: string, codPostal: string, act: string, stare_inregistrare: string, data_inregistrare: string, cod_CAEN: string, iban: string, statusRO_e_Factura: bool, organFiscalCompetent: string, forma_de_proprietate: string, forma_organizare: string, forma_juridica: string}, inregistrare_scop_Tva: array{scpTVA: bool, perioade_TVA: array<int,array{data_inceput_ScpTVA: ?string, data_sfarsit_ScpTVA: ?string, data_anul_imp_ScpTVA: ?string, mesaj_ScpTVA: ?string}>}, inregistrare_RTVAI: array{dataInceputTvaInc: string, dataSfarsitTvaInc: string, dataActualizareTvaInc: string, dataPublicareTvaInc: string, tipActTvaInc: string, statusTvaIncasare: bool}, stare_inactiv: array{dataInactivare: string, dataReactivare: string, dataPublicare: string, dataRadiere: string, statusInactivi: bool}, inregistrare_SplitTVA: array{dataInceputSplitTVA: string, dataAnulareSplitTVA: string, statusSplitTVA: bool}, adresa_sediu_social: array{sdenumire_Strada: string, snumar_Strada: string, sdenumire_Localitate: string, scod_Localitate: string, sdenumire_Judet: string, scod_Judet: string, scod_JudetAuto: string, stara: string, sdetalii_Adresa: string, scod_Postal: string}, adresa_domiciliu_fiscal: array{ddenumire_Strada: string, dnumar_Strada: string, ddenumire_Localitate: string, dcod_Localitate: string, ddenumire_Judet: string, dcod_Judet: string, dcod_JudetAuto: string, dtara: string, ddetalii_Adresa: string, dcod_Postal: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            RetrieveResponseGeneralData::from($attributes['date_generale']),
            RetrieveResponseVatRegistration::from($attributes['inregistrare_scop_Tva']),
            RetrieveResponseVatRegistrationAtCheckout::from($attributes['inregistrare_RTVAI']),
            RetrieveResponseInactiveState::from($attributes['stare_inactiv']),
            RetrieveResponseSplitVatRegistration::from($attributes['inregistrare_SplitTVA']),
            RetrieveResponseHqAddress::from($attributes['adresa_sediu_social']),
            RetrieveResponseFiscalAddress::from($attributes['adresa_domiciliu_fiscal']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'general_data' => $this->generalData->toArray(),
            'vat_registration' => $this->vatRegistration->toArray(),
            'vat_at_checkout' => $this->vatAtCheckout->toArray(),
            'inactive_state' => $this->inactiveState->toArray(),
            'split_vat' => $this->splitVat->toArray(),
            'hq_address' => $this->hqAddress->toArray(),
            'fiscal_address' => $this->fiscalAddress->toArray(),
        ];
    }
}
