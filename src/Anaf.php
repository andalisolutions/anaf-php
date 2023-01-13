<?php

declare(strict_types=1);

use Anaf\Client;
use Anaf\Enums\Transporter\ContentType;
use Anaf\Transporters\HttpTransporter;
use Anaf\ValueObjects\TaxIdentificationNumber;
use Anaf\ValueObjects\Transporter\BaseUri;
use Anaf\ValueObjects\Transporter\Headers;
use GuzzleHttp\Client as GuzzleClient;

final class Anaf
{
    /**
     * Creates a new Anaf Client with the given Tax Identification Number (romanian CUI).
     */
    public static function for(string $taxIdentificationNumber): Client
    {
        $taxIdentificationNumber = TaxIdentificationNumber::from($taxIdentificationNumber);

        $baseUri = BaseUri::from('webservicesp.anaf.ro');

        $headers = Headers::withContentType(ContentType::JSON);

        $client = new GuzzleClient();

        $transporter = new HttpTransporter($client, $baseUri, $headers);

        return new Client($transporter, $taxIdentificationNumber);
    }
}
