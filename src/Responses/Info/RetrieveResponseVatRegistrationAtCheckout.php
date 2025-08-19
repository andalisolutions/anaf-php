<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

class RetrieveResponseVatRegistrationAtCheckout
{
    private function __construct(
        public readonly string $startDate,
        public readonly string $stopDate,
        public readonly string $updateDate,
        public readonly string $publishDate,
        public readonly string $updatedType,
        public readonly bool $status,
    ) {}

    /**
     * @param array{dataInceputTvaInc: string, dataSfarsitTvaInc: string, dataActualizareTvaInc: string,
     *     dataPublicareTvaInc: string, tipActTvaInc: string, statusTvaIncasare: bool} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['dataInceputTvaInc'],
            $attributes['dataSfarsitTvaInc'],
            $attributes['dataActualizareTvaInc'],
            $attributes['dataPublicareTvaInc'],
            $attributes['tipActTvaInc'],
            $attributes['statusTvaIncasare'],
        );
    }

    /**
     * @return array{start_date: string, stop_date: string, update_date: string, publish_date: string, updated_type: string, status: bool}
     */
    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate,
            'stop_date' => $this->stopDate,
            'update_date' => $this->updateDate,
            'publish_date' => $this->publishDate,
            'updated_type' => $this->updatedType,
            'status' => $this->status,
        ];
    }
}
