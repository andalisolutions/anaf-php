<?php

use Anaf\ValueObjects\ResourceUri;

it('can be created', function () {
    $resourceUri = ResourceUri::create('foo');

    expect($resourceUri->toString())->toBe('foo');
});
