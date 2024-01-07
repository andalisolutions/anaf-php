<?php

declare(strict_types=1);

namespace Anaf\Enums\Efactura;

/**
 * @internal
 */
enum UploadStandard: string
{
    case UBL = 'UBL';
    case CN = 'CN';
    case CII = 'CII';
    case RASP = 'RASP';
}
