<?php

use Anaf\Contracts\FileContract;
use Anaf\Enums\Efactura\UploadStandard;
use Anaf\Requests\Efactura\MessagesRequest;
use Anaf\Requests\Efactura\UploadRequest;
use Anaf\Requests\Efactura\XmlToPdfRequest;
use Anaf\Responses\Efactura\CreateMessagesResponse;
use Anaf\Responses\Efactura\CreateUploadResponse;
use Anaf\Responses\Efactura\Message;

test('upload', function () {
    $authorizedClient = mockAuthorizedClient('POST', '/prod/FCTEL/rest/upload', getUploadMessage());

    $uploadParameters = UploadRequest::withXmlPath(__DIR__.'/../Fixtures/dummyxml.xml')
        ->withTaxIdentificationNumber('8000000000')
        ->withStandard(UploadStandard::UBL);

    $response = $authorizedClient->efactura()->upload($uploadParameters);

    expect($response)->toBeInstanceOf(CreateUploadResponse::class);
});

test('get messages', function () {
    $authorizedClient = mockAuthorizedClient('GET', '/prod/FCTEL/rest/listaMesajeFactura', getEfacturaMessages());

    $request = MessagesRequest::withTaxIdetificationNumber('8000000000')
        ->withDays(60);
    $response = $authorizedClient->efactura()->messages($request);

    expect($response)
        ->toBeInstanceOf(CreateMessagesResponse::class)
        ->toHaveProperty('messages')
        ->and($response->serial)
        ->toBe('1234AA456')
        ->and($response->taxIdentificationNumbers)
        ->toBe('8000000000')
        ->and($response->messages)
        ->toBeArray()
        ->and($response->messages[0])
        ->toBeInstanceOf(Message::class);

});

test('download efactura', function () {
    $authorizedClient = mockAuthorizedClient('GET', '/prod/FCTEL/rest/descarcare', getFakeFile('dummy content'), 'requestFile');

    $response = $authorizedClient->efactura()->download(1234456);

    expect($response)->toBeInstanceOf(FileContract::class)
        ->and($response->getContent())
        ->toBe('dummy content');
});

test('xml to pdf', function () {
    $authorizedClient = mockAuthorizedClient('POST', '/prod/FCTEL/rest/transformare/FACT1', getFakeFile('dummy pdf content'), 'requestFile');

    $request = XmlToPdfRequest::withXmlPath(__DIR__.'/../Fixtures/dummyxml.xml')
        ->withoutValidation();
    $response = $authorizedClient->efactura()->xmlToPdf($request);

    expect($response)->toBeInstanceOf(FileContract::class);
});
