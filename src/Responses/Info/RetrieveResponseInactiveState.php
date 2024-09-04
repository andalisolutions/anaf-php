<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

class RetrieveResponseInactiveState
{
    private function __construct(
        public readonly string $inactivationDate,
        public readonly string $reactivationDate,
        public readonly string $publishDate,
        public readonly string $deletionDate,
        public readonly bool $status,

    ) {}

    /**
     * @param  array{dataInactivare: string, dataReactivare: string, dataPublicare: string, dataRadiere: string, statusInactivi: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['dataInactivare'],
            $attributes['dataReactivare'],
            $attributes['dataPublicare'],
            $attributes['dataRadiere'],
            $attributes['statusInactivi'],
        );
    }

    /**
     * @return array{inactivation_date: string, reactivation_date: string, publish_date: string, deletion_date: string, status: bool}
     */
    public function toArray(): array
    {
        return [
            'inactivation_date' => $this->inactivationDate,
            'reactivation_date' => $this->reactivationDate,
            'publish_date' => $this->publishDate,
            'deletion_date' => $this->deletionDate,
            'status' => $this->status,
        ];
    }
}
