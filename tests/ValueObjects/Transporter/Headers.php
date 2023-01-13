<?php

use Anaf\Enums\Transporter\ContentType;
use Anaf\ValueObjects\Transporter\Headers;

it('can have content/type', function () {
    $headers = Headers::withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'Content-Type' => 'application/json',
    ]);
});
