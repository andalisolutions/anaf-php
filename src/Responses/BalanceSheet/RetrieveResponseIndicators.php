<?php

declare(strict_types=1);

namespace Anaf\Responses\BalanceSheet;

class RetrieveResponseIndicators
{
    private function __construct(
        public readonly string $indicator,
        public readonly int $value,
        public readonly string $indicatorName,
    ) {
    }

    /**
     * @param  array{indicator: string, val_indicator: int, val_den_indicator: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['indicator'],
            $attributes['val_indicator'],
            $attributes['val_den_indicator'],
        );
    }

    /**
     * @return array{indicator: string, value: int, indicator_name: string}
     */
    public function toArray(): array
    {
        return [
            'indicator' => $this->indicator,
            'value' => $this->value,
            'indicator_name' => $this->indicatorName,
        ];
    }
}
