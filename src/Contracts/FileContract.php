<?php

declare(strict_types=1);

namespace Anaf\Contracts;

/**
 * @internal
 */
interface FileContract
{
    /**
     * Save the file to the given path.
     */
    public function getContent(): string;
}
