<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

final class RetrieveResponseGeneralData
{
    private function __construct(
        public readonly int $taxIdentificationNumber,
        public readonly string $searchDate,
        public readonly string $companyName,
        public readonly string $address,
        public readonly string $registrationNumber,
        public readonly string $phone,
        public readonly string $fax,
        public readonly string $postalCode,
        public readonly string $document,
        public readonly string $registrationStatus,
        public readonly string $registrationDate,
        public readonly string $activityCode,
        public readonly string $bankAccount,
        public readonly bool $roInvoiceStatus,
        public readonly string $authorityName,
    ) {
    }

    /**
     * @param  array{cui: int, data: string, denumire: string, adresa: string, nrRegCom: string, telefon: string, fax: string, codPostal: string, act: string, stare_inregistrare: string, data_inregistrare: string, cod_CAEN: string, iban: string, statusRO_e_Factura: bool, organFiscalCompetent: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['cui'],
            $attributes['data'],
            $attributes['denumire'],
            $attributes['adresa'],
            $attributes['nrRegCom'],
            $attributes['telefon'],
            $attributes['fax'],
            $attributes['codPostal'],
            $attributes['act'],
            $attributes['stare_inregistrare'],
            $attributes['data_inregistrare'],
            $attributes['cod_CAEN'],
            $attributes['iban'],
            $attributes['statusRO_e_Factura'],
            $attributes['organFiscalCompetent'],
        );
    }

    /**
     * @return array{tax_identification_number: int, search_date: string, company_name: string, address: string, registration_number: string, phone: string, fax: string, postal_code: string, document: string, registration_status: string, registration_date: string, activity_code: string, bank_account: string, ro_invoice_status: bool, authority_name: string}
     */
    public function toArray(): array
    {
        return [
            'tax_identification_number' => $this->taxIdentificationNumber,
            'search_date' => $this->searchDate,
            'company_name' => $this->companyName,
            'address' => $this->address,
            'registration_number' => $this->registrationNumber,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'postal_code' => $this->postalCode,
            'document' => $this->document,
            'registration_status' => $this->registrationStatus,
            'registration_date' => $this->registrationDate,
            'activity_code' => $this->activityCode,
            'bank_account' => $this->bankAccount,
            'ro_invoice_status' => $this->roInvoiceStatus,
            'authority_name' => $this->authorityName,
        ];
    }
}
