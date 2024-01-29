<?php

declare(strict_types=1);

namespace Anaf\Enums\Efactura;

enum ConvertXmlStandard: string
{
    case INVOICE = 'FACT1';
    case CREDIT_NOTE = 'FCN';
}
