<?php

declare(strict_types=1);

namespace Anaf\Responses\Efactura;

class Message
{
    private function __construct(
        public readonly string $creationDate,
        public readonly string $taxIdentificationNumber,
        public readonly string $solicitationId,
        public readonly string $details,
        public readonly string $type,
        public readonly string $id,
    ) {
    }

    /**
     * @param  array{data_creare: string, cif: string, id_solicitare: string, detalii: string, tip: string, id: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['data_creare'],
            $attributes['cif'],
            $attributes['id_solicitare'],
            $attributes['detalii'],
            $attributes['tip'],
            $attributes['id'],
        );
    }

    /**
     * @return array{creation_date: string, tax_identification_number: string, solicitation_id: string, details: string, type: string, id: string}
     */
    public function toArray(): array
    {
        return [
            'creation_date' => $this->creationDate,
            'tax_identification_number' => $this->taxIdentificationNumber,
            'solicitation_id' => $this->solicitationId,
            'details' => $this->details,
            'type' => $this->type,
            'id' => $this->id,
        ];
    }
}
