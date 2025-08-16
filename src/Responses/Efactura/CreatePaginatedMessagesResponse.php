<?php

declare(strict_types=1);

namespace Anaf\Responses\Efactura;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{messages: array<int, array{creation_date: string, tax_identification_number: string, solicitation_id: string, details: string, type: string, id: string}>, count_messages_current_page: int, per_page: int, total_messages: int, total_pages: int, current_page: int, serial: string, tax_identification_numbers: string, title: string}>
 */
class CreatePaginatedMessagesResponse implements Response
{
    /**
     * @use ArrayAccessible<array{messages: array<int, Message>, count_messages_current_page: int, per_page: int, total_messages: int, total_pages: int, current_page: int, serial: string, tax_identification_numbers: string, title: string}>
     */
    use ArrayAccessible;

    /**
     * Creates a new CreateResponse instance.
     *
     * @param  array<int, Message>  $messages
     */
    private function __construct(
        public readonly array $messages,
        public readonly string $serial,
        public readonly string $taxIdentificationNumbers,
        public readonly string $title,
        public readonly int $countMessagesCurrentPage,
        public readonly int $perPage,
        public readonly int $totalMessages,
        public readonly int $totalPages,
        public readonly int $currentPage,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{mesaje: array<int, array{data_creare: string, cif: string, id_solicitare: string, detalii: string, tip: string, id: string}>, numar_inregistrari_in_pagina: int, numar_total_inregistrari_per_pagina: int, numar_total_inregistrari: int, numar_total_pagini: int, index_pagina_curenta:int, serial: string, cui: string, titlu: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        $messages = array_map(
            static fn (array $result): Message => Message::from(
                $result
            ),
            $attributes['mesaje'],
        );

        return new self(
            $messages,
            $attributes['serial'],
            $attributes['cui'],
            $attributes['titlu'],
            $attributes['numar_inregistrari_in_pagina'],
            $attributes['numar_total_inregistrari_per_pagina'],
            $attributes['numar_total_inregistrari'],
            $attributes['numar_total_pagini'],
            $attributes['index_pagina_curenta'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'messages' => array_map(
                static fn (Message $result): array => $result->toArray(),
                $this->messages,
            ),
            'count_messages_current_page' => $this->countMessagesCurrentPage,
            'per_page' => $this->perPage,
            'total_messages' => $this->totalMessages,
            'total_pages' => $this->totalPages,
            'current_page' => $this->currentPage,
            'serial' => $this->serial,
            'tax_identification_numbers' => $this->taxIdentificationNumbers,
            'title' => $this->title,
        ];
    }
}
