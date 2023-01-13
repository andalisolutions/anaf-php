<?php

use Anaf\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('webservicesp.anaf.ro');

    expect($baseUri->toString())->toBe('https://webservicesp.anaf.ro/');
});
