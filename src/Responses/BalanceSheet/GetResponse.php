<?php

declare(strict_types=1);

namespace Anaf\Responses\BalanceSheet;

use Anaf\Contracts\Indicator;
use Anaf\Contracts\Response;
use Anaf\Enums\BalanceSheet\BL;
use Anaf\Enums\BalanceSheet\OL;
use Anaf\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{year: int, tax_identification_number: int, company_name: string, activity_code: int, activity_name: string, indicators: array<string, array{indicator: string, value: int, indicator_name: string}>}>
 */
final class GetResponse implements Response
{
    /**
     * @use ArrayAccessible<array{year: int, tax_identification_number: int, company_name: string, activity_code: int, activity_name: string, indicators: array<string, array{indicator: string, value: int, indicator_name: string}>}>
     */
    use ArrayAccessible;

    /**
     * @param  array<string, RetrieveResponseIndicators>  $indicators
     */
    private function __construct(
        public readonly int $year,
        public readonly int $taxIdentificationNumber,
        public readonly string $companyName,
        public readonly int $activityCode,
        public readonly string $activityName,
        public readonly array $indicators,

    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{an: int, cui: int, deni: string, caen: int, den_caen: string, i: array<int, array{indicator: string, val_indicator: int, val_den_indicator: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        /*
         * @see https://static.anaf.ro/static/10/Anaf/Declaratii_R/AplicatiiDec/UniversalCode_2012.pdf for indicators type
         */
        $indicatorType = match ($attributes['i'][0]['val_den_indicator']) {
            'Numar mediu de salariati' => BL::class,
            'Efectivul de personal privind activitatile economice' => OL::class,
            default => BL::class,
        };

        $indicators = array_reduce($attributes['i'], function (array $result, $item) use ($indicatorType): array {
            $replaceDiacritics = (string) iconv('UTF-8', 'ASCII//TRANSLIT', $item['val_den_indicator']);
            $key = str_replace(['  ', ':'], [' ', ''], trim(strtoupper($replaceDiacritics)));
            $cleanKey = (string) preg_replace('/ - LA (\d{2}\.\d{2}\.\d{4})/', '', $key);

            $result[$indicatorType::from($cleanKey)->name] = RetrieveResponseIndicators::from($item);

            return $result;
        }, []);

        return new self(
            $attributes['an'],
            $attributes['cui'],
            $attributes['deni'],
            $attributes['caen'],
            $attributes['den_caen'],
            $indicators,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'year' => $this->year,
            'tax_identification_number' => $this->taxIdentificationNumber,
            'company_name' => $this->companyName,
            'activity_code' => $this->activityCode,
            'activity_name' => $this->activityName,
            'indicators' => array_map(
                static fn (RetrieveResponseIndicators $response): array => $response->toArray(),
                $this->indicators,
            ),
        ];
    }
}
