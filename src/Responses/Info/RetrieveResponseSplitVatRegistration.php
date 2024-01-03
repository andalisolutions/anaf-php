<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

class RetrieveResponseSplitVatRegistration
{
    private function __construct(
        public readonly string $startDate,
        public readonly string $stopDate,
        public readonly bool $status,

    ) {
    }

    /**
     * @param  array{dataInceputSplitTVA: string, dataAnulareSplitTVA: string, statusSplitTVA: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['dataInceputSplitTVA'],
            $attributes['dataAnulareSplitTVA'],
            $attributes['statusSplitTVA'],
        );
    }

    /**
     * @return array{start_date: string, stop_date: string, status: bool}
     */
    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate,
            'stop_date' => $this->stopDate,
            'status' => $this->status,
        ];
    }
}
