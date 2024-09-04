<?php

declare(strict_types=1);

namespace Anaf\Responses\Ngo;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{tax_identification_number: int, search_date: string, entity_name: string, address: string, phone: string, postal_code: string, document: string, registration_status: string, start_date: string, end_date: string, status: bool}>
 */
class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{tax_identification_number: int, search_date: string, entity_name: string, address: string, phone: string, postal_code: string, document: string, registration_status: string, start_date: string, end_date: string, status: bool}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly int $taxIdentificationNumber,
        public readonly string $searchDate,
        public readonly string $entityName,
        public readonly string $address,
        public readonly string $phone,
        public readonly string $postalCode,
        public readonly string $document,
        public readonly string $registrationStatus,
        public readonly string $startDate,
        public readonly string $endDate,
        public readonly bool $status,

    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{cui: int, data: string, denumire: string, adresa: string, telefon: string, codPostal: string, act: string, stare_inregistrare: string, dataInceputRegCult: string, dataAnulareRegCult: string, statusRegCult: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['cui'],
            $attributes['data'],
            $attributes['denumire'],
            $attributes['adresa'],
            $attributes['telefon'],
            $attributes['codPostal'],
            $attributes['act'],
            $attributes['stare_inregistrare'],
            $attributes['dataInceputRegCult'],
            $attributes['dataAnulareRegCult'],
            $attributes['statusRegCult'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'tax_identification_number' => $this->taxIdentificationNumber,
            'search_date' => $this->searchDate,
            'entity_name' => $this->entityName,
            'address' => $this->address,
            'phone' => $this->phone,
            'postal_code' => $this->postalCode,
            'document' => $this->document,
            'registration_status' => $this->registrationStatus,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'status' => $this->status,
        ];
    }
}
