<?php

declare(strict_types=1);

namespace Anaf\Enums\Efactura;

enum MessagesFilter: string
{
    case ERROR = 'E';
    case RECEIVED = 'P';
    case SENT = 'T';
    case MESSAGE_RESPONSE = 'R';
}
