<?php

declare(strict_types=1);

namespace Anaf\Responses\Info;

class RetrieveResponseHqAddress
{
    private function __construct(
        public readonly string $street,
        public readonly string $no,
        public readonly string $city,
        public readonly string $cityCode,
        public readonly string $county,
        public readonly string $countyCode,
        public readonly string $countyShort,
        public readonly string $country,
        public readonly string $details,
        public readonly string $postalCode,
    ) {}

    /**
     * @param  array{sdenumire_Strada: string, snumar_Strada: string, sdenumire_Localitate: string, scod_Localitate: string, sdenumire_Judet: string, scod_Judet: string, scod_JudetAuto: string, stara: string, sdetalii_Adresa: string, scod_Postal: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['sdenumire_Strada'],
            $attributes['snumar_Strada'],
            $attributes['sdenumire_Localitate'],
            $attributes['scod_Localitate'],
            $attributes['sdenumire_Judet'],
            $attributes['scod_Judet'],
            $attributes['scod_JudetAuto'],
            $attributes['stara'],
            $attributes['sdetalii_Adresa'],
            $attributes['scod_Postal'],
        );
    }

    /**
     * @return array{street: string, no: string, city: string, city_code: string, county: string, county_code: string, county_short: string, country: string, details: string, postalCode: string}
     */
    public function toArray(): array
    {
        return [
            'street' => $this->street,
            'no' => $this->no,
            'city' => $this->city,
            'city_code' => $this->cityCode,
            'county' => $this->county,
            'county_code' => $this->countyCode,
            'county_short' => $this->countyShort,
            'country' => $this->country,
            'details' => $this->details,
            'postalCode' => $this->postalCode,
        ];
    }
}
