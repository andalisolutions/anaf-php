<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Responses\BalanceSheet\GetResponse;
use Anaf\ValueObjects\Transporter\Payload;

final class BalanceSheet
{
    use Concerns\Transportable;

    /**
     * Get public info about the given tax identification number if are registered in the Register of religious entities/units
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html
     */
    public function forYear(string $year): GetResponse
    {
        $payload = Payload::get('bilant', $this->taxIdentificationNumber->toString(), $year);

        /**
         * @var array{an: int, cui: int, deni: string, caen: int, den_caen: string, i: array<int, array{indicator: string, val_indicator: int, val_den_indicator: string}>} $result
         */
        $result = $this->transporter->requestObject($payload);

        return GetResponse::from($result);
    }
}
