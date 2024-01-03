<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

class RetrieveResponseVatPeriods
{
    private function __construct(
        public readonly ?string $startDate,
        public readonly ?string $stopDate,
        public readonly ?string $stopEffectiveDate,
        public readonly ?string $message,
    ) {
    }

    /**
     * @param  array{data_inceput_ScpTVA: ?string, data_sfarsit_ScpTVA: ?string, data_anul_imp_ScpTVA: ?string, mesaj_ScpTVA: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['data_inceput_ScpTVA'],
            $attributes['data_sfarsit_ScpTVA'],
            $attributes['data_anul_imp_ScpTVA'],
            $attributes['mesaj_ScpTVA'],
        );
    }

    /**
     * @return array{start_date: ?string, stop_date: ?string, stop_effective_date: ?string, message: ?string}
     */
    public function toArray(): array
    {
        return [
            'start_date' => $this->startDate,
            'stop_date' => $this->stopDate,
            'stop_effective_date' => $this->stopEffectiveDate,
            'message' => $this->message,
        ];
    }
}
