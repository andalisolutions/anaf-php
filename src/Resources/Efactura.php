<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Contracts\FileContract;
use Anaf\Requests\Efactura\MessagesRequest;
use Anaf\Requests\Efactura\UploadRequest;
use Anaf\Requests\Efactura\XmlToPdfRequest;
use Anaf\Responses\Efactura\CreateMessagesResponse;
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
    public function upload(UploadRequest $uploadRequest): CreateUploadResponse
    {
        $payload = Payload::upload(
            resource: 'prod/FCTEL/rest/upload',
            body: Xml::from($uploadRequest->getXmlPath())->toString(),
            parameters: $uploadRequest->toArray(),
        );

        /** @var array<array-key, array{dateResponse: string, ExecutionStatus: string, index_incarcare: string}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateUploadResponse::from($response['@attributes']);
    }

    /**
     * Get the list of messages for a given taxpayer.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/listamesaje.html
     */
    public function messages(MessagesRequest $messagesRequest): CreateMessagesResponse
    {
        $payload = Payload::get('prod/FCTEL/rest/listaMesajeFactura', $messagesRequest->toArray());

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
     * Download an eFactura XML file from ANAF.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/descarcare.html
     */
    public function download(int $id): FileContract
    {
        $payload = Payload::get('prod/FCTEL/rest/descarcare', [
            'id' => (string) $id,
        ]);

        return $this->transporter->requestFile($payload);
    }

    /**
     * Convert eFactura from XML to PDF.
     *
     * @see https://mfinante.gov.ro/static/10/eFactura/xmltopdf.html
     *
     * @throws Exception
     */
    public function xmlToPdf(XmlToPdfRequest $xmlToPdfRequest): FileContract
    {
        $validateFile = $xmlToPdfRequest->validate ? '/DA' : '';

        $payload = Payload::upload(
            resource: "prod/FCTEL/rest/transformare/{$xmlToPdfRequest->standard->value}{$validateFile}",
            body: Xml::from($xmlToPdfRequest->getXmlPath())->toString(),
        );

        return $this->transporter->requestFile($payload);
    }
}
