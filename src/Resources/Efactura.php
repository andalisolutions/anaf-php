<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Contracts\FileContract;
use Anaf\Enums\Efactura\UploadStandard;
use Anaf\Responses\Efactura\CreateMessagesResponse;
use Anaf\Responses\Efactura\CreatePaginatedMessagesResponse;
use Anaf\Responses\Efactura\CreateSignatureValidationResponse;
use Anaf\Responses\Efactura\CreateUploadResponse;
use Anaf\ValueObjects\Transporter\Payload;
use Anaf\ValueObjects\Transporter\Xml;
use Exception;
use RuntimeException;

class Efactura
{
    use Concerns\Transportable;

    /**
     * Upload an eFactura XML file to ANAF.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/upload.html
     *
     * @throws Exception
     */
    public function upload(
        string $xml_path,
        string $tax_identification_number,
        UploadStandard $standard = UploadStandard::UBL,
        bool $extern = false,
        bool $selfInvoice = false,
        bool $execution = false,
    ): CreateUploadResponse {
        $payload = Payload::upload(
            resource: 'prod/FCTEL/rest/upload',
            body: Xml::from($xml_path)->toString(),
            parameters: [
                'cif' => $tax_identification_number,
                'standard' => $standard->value,
                ...($extern ? ['extern' => 'DA'] : []),
                ...($selfInvoice ? ['autofactura' => 'DA'] : []),
                ...($execution ? ['executare' => 'DA'] : []),
            ],
        );

        /** @var array<array-key, array{dateResponse: string, ExecutionStatus: string, index_incarcare: string}> $response */
        $response = $this->transporter->requestObject($payload);

        if (! array_key_exists('@attributes', $response)) {
            /** @var array{message: string} $response */
            throw new RuntimeException($response['message']);
        }

        return CreateUploadResponse::from($response['@attributes']);
    }

    /**
     * Get the list of messages for a given taxpayer.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/listamesaje.html
     *
     * @param  array<string, string>  $parameters
     */
    public function messages(array $parameters): CreateMessagesResponse
    {
        $payload = Payload::get('prod/FCTEL/rest/listaMesajeFactura', $parameters);

        /**
         * @var array{eroare?: string, mesaje: array<int, array{data_creare: string, cif: string, id_solicitare: string, detalii: string, tip: string, id: string}>, serial: string, cui: string, titlu: string} $response
         */
        $response = $this->transporter->requestObject($payload);

        if (array_key_exists('eroare', $response)) {
            throw new RuntimeException($response['eroare']);
        }

        return CreateMessagesResponse::from($response);
    }

    /**
     * Get the list of messages for a given taxpayer.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/listamesaje.html#/EFacturaListaMesaje/getPaginatie
     *
     * @param  array<string, string>  $parameters
     */
    public function paginatedMessages(array $parameters): CreatePaginatedMessagesResponse
    {
        $payload = Payload::get('prod/FCTEL/rest/listaMesajePaginatieFactura', $parameters);

        /**
         * @var array{eroare?: string, mesaje: array<int, array{data_creare: string, cif: string, id_solicitare: string, detalii: string, tip: string, id: string}>, numar_inregistrari_in_pagina: int, numar_total_inregistrari_per_pagina: int, numar_total_inregistrari: int, numar_total_pagini: int, index_pagina_curenta:int, serial: string, cui: string, titlu: string} $response
         */
        $response = $this->transporter->requestObject($payload);

        if (array_key_exists('eroare', $response)) {
            throw new RuntimeException($response['eroare']);
        }

        return CreatePaginatedMessagesResponse::from($response);
    }

    /**
     * Get the list of messages for a given taxpayer.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/descarcare.html
     *
     * @param  array<string, string>  $parameters
     */
    public function download(array $parameters): FileContract
    {
        $payload = Payload::get('prod/FCTEL/rest/descarcare', $parameters);

        return $this->transporter->requestFile($payload);
    }

    /**
     * Convert eFactura from XML to PDF.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/xmltopdf.html
     *
     * @throws Exception
     */
    public function xmlToPdf(string $xml_path, string $standard = 'FACT1', bool $validate = true): FileContract
    {
        if (! in_array($standard, ['FACT1', 'FCN'])) {
            throw new RuntimeException("Invalid standard {$standard}");
        }

        $validateFile = $validate ? '/DA' : '';

        $payload = Payload::upload(
            resource: "prod/FCTEL/rest/transformare/{$standard}{$validateFile}",
            body: Xml::from($xml_path)->toString(),
        );

        return $this->transporter->requestFile($payload);
    }

    /**
     * Validate the signature of an eFactura XML file.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/validaresemnatura.html
     *
     * @throws Exception
     */
    public function xmlSignatureValidation(string $xml_path, string $signature_path): CreateSignatureValidationResponse
    {
        $payload = Payload::uploadSignatureValidation(
            resource: 'api/validate/signature',
            body: Xml::from($xml_path)->toString(),
            signature: Xml::from($signature_path)->toString(),
        );

        /**
         * @var array{msg: string} $response
         */
        $response = $this->transporter->requestObject($payload);

        return CreateSignatureValidationResponse::from($response);
    }
}
