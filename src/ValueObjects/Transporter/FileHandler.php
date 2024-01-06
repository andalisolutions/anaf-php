<?php

declare(strict_types=1);

namespace Anaf\ValueObjects\Transporter;

use Anaf\Contracts\FileContract;

/**
 * @internal
 */
class FileHandler implements FileContract
{
    /**
     * Creates a new Base URI value object.
     */
    public function __construct(
        private readonly string $fileContent,
    ) {
        // ..
    }

    public function getContent(): string
    {
        return $this->fileContent;
    }
}
