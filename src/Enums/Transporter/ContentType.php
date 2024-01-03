<?php

declare(strict_types=1);

namespace Anaf\Enums\Transporter;

/**
 * @internal
 */
enum ContentType: string
{
    case JSON = 'application/json';
    case ALL = '*/*';
    case TEXT = 'text/plain';
}
