<?php

declare(strict_types=1);

namespace Anaf\Contracts;

use Anaf\Exceptions\TaxIdentificationNumberNotFoundException;
use Anaf\Exceptions\TransporterException;
use Anaf\Exceptions\UnserializableResponse;
use Anaf\ValueObjects\Transporter\Payload;

/**
 * @internal
 */
interface Transporter
{
    /**
     * Sends a request to a server.
     **
     * @return array<array-key, mixed>
     *
     * @throws UnserializableResponse|TransporterException|TaxIdentificationNumberNotFoundException
     */
    public function requestObject(Payload $payload): array;
}
