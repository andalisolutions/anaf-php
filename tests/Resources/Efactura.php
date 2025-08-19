<?php

use Anaf\Contracts\FileContract;
use Anaf\Responses\Efactura\CreateMessagesResponse;
use Anaf\Responses\Efactura\CreatePaginatedMessagesResponse;
use Anaf\Responses\Efactura\CreateUploadResponse;
use Anaf\Responses\Efactura\Message;
use Anaf\Responses\Efactura\ValidationResponse;

test('upload', function () {
    $authorizedClient = mockAuthorizedClient('POST', '/prod/FCTEL/rest/upload', getUploadMessage());

    $response = $authorizedClient->efactura()->upload(
        xml_path: __DIR__.'/../Fixtures/dummyxml.xml',
        tax_identification_number: '8000000000',
    );

    expect($response)->toBeInstanceOf(CreateUploadResponse::class);
});

test('get messages', function () {
    $authorizedClient = mockAuthorizedClient('GET', '/prod/FCTEL/rest/listaMesajeFactura', getEfacturaMessages());

    $response = $authorizedClient->efactura()->messages(
        [
            'zile' => 60,
            'cif' => '8000000000',
        ],
    );

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

test('get paginated messages', function () {
    $authorizedClient = mockAuthorizedClient('GET', '/prod/FCTEL/rest/listaMesajePaginatieFactura', getEfacturaPaginatedMessages());

    $response = $authorizedClient->efactura()->paginatedMessages(
        [
            'startTime' => 1706738400000,
            'endTime' => 1707343800000,
            'cif' => 8000000000,
            'pagina' => 2,
        ],
    );

    expect($response)
        ->toBeInstanceOf(CreatePaginatedMessagesResponse::class)
        ->toHaveProperty('messages')
        ->and($response->serial)
        ->toBe('1234AA456')
        ->and($response->taxIdentificationNumbers)
        ->toBe('8000000000')
        ->and($response->currentPage)
        ->toBe(29)
        ->and($response->messages)
        ->toBeArray()
        ->and($response->messages[0])
        ->toBeInstanceOf(Message::class);

});

test('download efactura', function () {
    $authorizedClient = mockAuthorizedClient('GET', '/prod/FCTEL/rest/descarcare', getFakeFile('dummy content'), 'requestFile');

    $response = $authorizedClient->efactura()->download(
        [
            'id' => '1234AA456',
        ],
    );

    expect($response)->toBeInstanceOf(FileContract::class)
        ->and($response->getContent())
        ->toBe('dummy content');
});

test('xml to pdf', function () {
    $authorizedClient = mockAuthorizedClient('POST', '/prod/FCTEL/rest/transformare/FACT1', getFakeFile('dummy pdf content'), 'requestFile');

    $response = $authorizedClient->efactura()->xmlToPdf(__DIR__.'/../Fixtures/dummyxml.xml', validate: false);

    expect($response)->toBeInstanceOf(FileContract::class);
});

test('validate valid xml', function () {
    $authorizedClient = mockClient('POST', '/prod/FCTEL/rest/validare/FACT1', getXmlValidationMessage());

    $response = $authorizedClient->efactura()->validateXml(__DIR__ . '/../Fixtures/dummyxml.xml');

    expect($response)->toBeInstanceOf(ValidationResponse::class)
        ->toArray()
        ->toHaveKey('stare', 'ok')
        ->and($response)
        ->isValid()
        ->toBeTrue();
});


test('validate invalid xml', function () {
    $authorizedClient = mockClient('POST', '/prod/FCTEL/rest/validare/FACT1', getXmlValidationMessage(false));

    $response = $authorizedClient->efactura()->validateXml(__DIR__ . '/../Fixtures/dummyxml.xml');

    expect($response)->toBeInstanceOf(ValidationResponse::class)
        ->toArray()
        ->toHaveKey('stare', 'nok')
        ->and($response)
        ->isValid()
        ->toBeFalse();
});
