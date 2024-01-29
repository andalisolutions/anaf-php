<?php

use Anaf\Enums\Efactura\ConvertXmlStandard;
use Anaf\Requests\Efactura\XmlToPdfRequest;

it('can be created', function () {
    $xmlToPdfRequest = XmlToPdfRequest::withXmlPath('dummyxmlpath.xml')
        ->withStandard(ConvertXmlStandard::INVOICE);

    expect($xmlToPdfRequest->getXmlPath())->toBe('dummyxmlpath.xml')
        ->and($xmlToPdfRequest->standard->value)->toBe('FACT1')
        ->and($xmlToPdfRequest->validate)->toBeTrue();
});

it('can be created without validation', function () {
    $xmlToPdfRequest = XmlToPdfRequest::withXmlPath('dummyxmlpath.xml')
        ->withStandard(ConvertXmlStandard::INVOICE)
        ->withoutValidation();

    expect($xmlToPdfRequest->getXmlPath())->toBe('dummyxmlpath.xml')
        ->and($xmlToPdfRequest->standard->value)->toBe('FACT1')
        ->and($xmlToPdfRequest->validate)->toBeFalse();
});

it('can be created without validation method order random', function () {
    $xmlToPdfRequest = XmlToPdfRequest::withXmlPath('dummyxmlpath.xml')
        ->withoutValidation()
        ->withStandard(ConvertXmlStandard::CREDIT_NOTE);

    expect($xmlToPdfRequest->getXmlPath())->toBe('dummyxmlpath.xml')
        ->and($xmlToPdfRequest->standard->value)->toBe('FCN')
        ->and($xmlToPdfRequest->validate)->toBeFalse();
});
