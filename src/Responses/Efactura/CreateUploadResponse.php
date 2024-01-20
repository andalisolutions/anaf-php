<?php

declare(strict_types=1);

namespace Anaf\Responses\Efactura;

use Anaf\Contracts\Response;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{response_date: string, execution_status: string, upload_index: string}>
 */
class CreateUploadResponse implements Response
{
    /**
     * @use ArrayAccessible<array{response_date: string, execution_status: string, upload_index: string}>
     */
    use ArrayAccessible;

    /**
     * Creates a new CreateResponse instance.
     */
    private function __construct(
        public readonly string $responseDate,
        public readonly string $executionStatus,
        public readonly string $uploadIndex,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{dateResponse: string, ExecutionStatus: string, index_incarcare: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['dateResponse'],
            $attributes['ExecutionStatus'],
            $attributes['index_incarcare'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'response_date' => $this->responseDate,
            'execution_status' => $this->executionStatus,
            'upload_index' => $this->uploadIndex,
        ];
    }
}
