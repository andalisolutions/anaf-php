<?php

namespace Anaf\Responses\Efactura;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{stare: string, trace_id: string, messages: list<array{message: string}>}>
 */
class ValidationResponse implements Response
{
    /**
     * @use ArrayAccessible<array{stare: string, trace_id: string, messages: list<array{message: string}>}>
     */
    use ArrayAccessible;

    /**
     * Creates a new ValidationResponse instance.
     *
     * @param string $status
     * @param string $traceId
     * @param list<array{message: string}> $messages
     */
    public function __construct(
        public readonly string $status,
        public readonly string $traceId,
        public readonly array  $messages,
    ){}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{stare: string, trace_id: string, Messages: null|list<array{message: string}>} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['stare'],
            $attributes['trace_id'],
            $attributes['Messages'] ?? [],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'stare'   => $this->status,
            'trace_id' => $this->traceId,
            'messages' => $this->messages,
        ];
    }

    /**
     * Returns a bool to quick check if the xml was valid or not
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->status === 'ok';
    }
}
