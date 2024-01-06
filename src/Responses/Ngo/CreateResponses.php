<?php

declare(strict_types=1);

namespace Anaf\Responses\Ngo;

class CreateResponses
{
    /**
     * @param  array<int, CreateResponse>  $responses
     */
    private function __construct(
        public readonly array $responses,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array<int, array{cui: int, data: string, denumire: string, adresa: string, telefon: string, codPostal: string, act: string, stare_inregistrare: string, dataInceputRegCult: string, dataAnulareRegCult: string, statusRegCult: bool}>  $attributes
     */
    public static function from(array $attributes): self
    {
        $responses = array_map(
            static fn (array $result): CreateResponse => CreateResponse::from($result),
            $attributes,
        );

        return new self($responses);
    }

    /**
     * @return array<int, array{tax_identification_number: int, search_date: string, entity_name: string, address: string, phone: string, postal_code: string, document: string, registration_status: string, start_date: string, end_date: string, status: bool}>
     */
    public function toArray(): array
    {
        return array_map(
            static fn (CreateResponse $result): array => $result->toArray(),
            $this->responses,
        );
    }
}
