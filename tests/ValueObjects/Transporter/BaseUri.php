<?php

use Anaf\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('webservicesp.anaf.ro');

    expect($baseUri->toString())->toBe('https://webservicesp.anaf.ro/');
});

it('can be created from a string with http protocol', function () {
    $baseUri = BaseUri::from('http://api.anaf.ro');

    expect($baseUri->toString())->toBe('http://api.anaf.ro/');
});

it('can be created from a string with https protocol', function () {
    $baseUri = BaseUri::from('https://api.anaf.ro');

    expect($baseUri->toString())->toBe('https://api.anaf.ro/');
});
