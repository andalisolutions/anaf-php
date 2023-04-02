<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

final class RetrieveResponseVatRegistration
{
    /**
     * @param  array<int, RetrieveResponseVatPeriods>  $vatPeriods
     */
    private function __construct(
        public readonly bool $status,
        public readonly array $vatPeriods,
    ) {
    }

    /**
     * @param  array{scpTVA: bool, perioade_TVA: array<int, array{data_inceput_ScpTVA: ?string, data_sfarsit_ScpTVA: ?string, data_anul_imp_ScpTVA: ?string, mesaj_ScpTVA: ?string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $vatPeriods = array_map(fn (array $result): RetrieveResponseVatPeriods => RetrieveResponseVatPeriods::from(
            $result
        ), $attributes['perioade_TVA']);
        return new self(
            $attributes['scpTVA'],
            $vatPeriods,
        );
    }

    /**
     * @return array{status: bool, vat_periods: array<int, array{start_date: ?string, stop_date: ?string, stop_effective_date: ?string, message: ?string}>}
     */
    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'vat_periods' => array_map(
                static fn (RetrieveResponseVatPeriods $result): array => $result->toArray(),
                $this->vatPeriods,
            ),
        ];
    }
}
