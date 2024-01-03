<?php

declare(strict_types=1);

namespace Anaf\Exceptions;

use Exception;

class FileTypeException extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct()
    {
        parent::__construct('File type not allowed for saving or downloading.');
    }
}
