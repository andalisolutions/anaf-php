<?php

declare(strict_types=1);

namespace Anaf\Exceptions;

use Exception;
use JsonException;

class UnserializableResponse extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
