<?php

declare(strict_types=1);

namespace Anaf\Responses\Efactura;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{messages: array<int, array{creation_date: string, tax_identification_number: string, solicitation_id: string, details: string, type: string, id: string}>, serial: string, tax_identification_numbers: string, title: string}>
 */
class CreateMessagesResponse implements Response
{
    /**
     * @use ArrayAccessible<array{messages: array<int, Message>, serial: string, tax_identification_numbers: string, title: string}>
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
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{mesaje: array<int, array{data_creare: string, cif: string, id_solicitare: string, detalii: string, tip: string, id: string}>, serial: string, cui: string, titlu: string}  $attributes
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
            'serial' => $this->serial,
            'tax_identification_numbers' => $this->taxIdentificationNumbers,
            'title' => $this->title,
        ];
    }
}
