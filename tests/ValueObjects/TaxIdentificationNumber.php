<?php

// Generate tax identification number value object...

use Anaf\ValueObjects\TaxIdentificationNumber;

it('can be created from a string with prefix', function () {
    $apiKey = TaxIdentificationNumber::from('RO38744563');

    expect($apiKey->toString())->toBe('38744563');
});

it('can be created from a string without prefix', function () {
    $apiKey = TaxIdentificationNumber::from('38744563');

    expect($apiKey->toString())->toBe('38744563');
});

it('will be clean', function () {
    $apiKey = TaxIdentificationNumber::from(' Ro38744563');

    expect($apiKey->toString())->toBe('38744563');
});
