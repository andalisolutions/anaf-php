<?php

use Anaf\Enums\Efactura\UploadStandard;
use Anaf\Requests\Efactura\UploadRequest;

it('can be created ', function () {
    $uploadParameters = UploadRequest::withXmlPath('dummyxmlpath.xml')
        ->withTaxIdentificationNumber('8000000000')
        ->withStandard(UploadStandard::UBL);

    expect($uploadParameters->getXmlPath())->toBe('dummyxmlpath.xml')
        ->and($uploadParameters->toArray())->toBe([
            'cif' => '8000000000',
            'standard' => 'UBL',
        ]);
});

it('can be created for extern invoices ', function () {
    $uploadParameters = UploadRequest::withXmlPath('dummyxmlpath.xml')
        ->withTaxIdentificationNumber('8000000000')
        ->withStandard(UploadStandard::UBL)
        ->extern();

    expect($uploadParameters->getXmlPath())->toBe('dummyxmlpath.xml')
        ->and($uploadParameters->toArray())->toBe([
            'cif' => '8000000000',
            'standard' => 'UBL',
            'extern' => 'DA',
        ]);
});

it('can be created for self invoices ', function () {
    $uploadParameters = UploadRequest::withXmlPath('dummyxmlpath.xml')
        ->withTaxIdentificationNumber('8000000000')
        ->withStandard(UploadStandard::UBL)
        ->selfInvoice();

    expect($uploadParameters->getXmlPath())->toBe('dummyxmlpath.xml')
        ->and($uploadParameters->toArray())->toBe([
            'cif' => '8000000000',
            'standard' => 'UBL',
            'autofactura' => 'DA',
        ]);
});

it('can throw exception when xml path is not set', function () {
    UploadRequest::withXmlPath('')
        ->withStandard(UploadStandard::UBL)
        ->toArray();
})->throws(InvalidArgumentException::class);

it('can throw exception when tax identification number is not set', function () {
    UploadRequest::withXmlPath('dummyxmlpath.xml')
        ->withStandard(UploadStandard::UBL)
        ->toArray();
})->throws(InvalidArgumentException::class);

it('can throw exception when standard is not set', function () {
    UploadRequest::withXmlPath('dummyxmlpath.xml')
        ->withTaxIdentificationNumber('8000000000')
        ->toArray();
})->throws(InvalidArgumentException::class);
