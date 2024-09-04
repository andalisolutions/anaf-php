<?php

declare(strict_types=1);

namespace Anaf\Responses\Efactura;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{message: string}>
 */
class CreateSignatureValidationResponse implements Response
{
    /**
     * @use ArrayAccessible<array{message: string}>
     */
    use ArrayAccessible;

    /**
     * Creates a new CreateResponse instance.
     */
    private function __construct(
        public readonly string $msg,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{msg: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['msg'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'message' => $this->msg,
        ];
    }
}
