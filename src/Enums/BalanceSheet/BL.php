<?php

namespace Anaf\Enums\BalanceSheet;

use Anaf\Contracts\Indicator;

enum BL: string implements Indicator
{
    case AVERAGE_NUMBER_OF_EMPLOYEES = 'NUMAR MEDIU DE SALARIATI';
    case NET_LOSS = 'PIERDERE NETA';
    case NET_PROFIT = 'PROFIT NET';
    case GROSS_LOSS = 'PIERDERE BRUTA';
    case GROSS_PROFIT = 'PROFIT BRUT';
    case TOTAL_EXPENSES = 'CHELTUIELI TOTALE';
    case TOTAL_INCOME = 'VENITURI TOTALE';
    case NET_TURNOVER = 'CIFRA DE AFACERI NETA';
    case HERITAGE_OF_THE_KINGDOM = 'PATRIMONIUL REGIEI';
    case PAID_SUBSCRIBED_CAPITAL = 'CAPITAL SUBSCRIS VARSAT';
    case CAPITAL_TOTAL = 'CAPITALURI - TOTAL, DIN CARE';
    case PROVISIONS = 'PROVIZIOANE';
    case ADVANCE_INCOME = 'VENITURI IN AVANS';
    case LIABILITIES = 'DATORII';
    case PREPAYMENTS = 'CHELTUIELI IN AVANS';
    case HOME_AND_BANK_ACCOUNTS = 'CASA SI CONTURI LA BANCI';
    case DEBT = 'CREANTE';
    case INVENTORIES = 'STOCURI';
    case CURRENT_ASSETS = 'ACTIVE CIRCULANTE - TOTAL, DIN CARE';
    case FIXED_ASSETS = 'ACTIVE IMOBILIZATE - TOTAL';

    public function code(): string
    {
        return match ($this) {
            self::AVERAGE_NUMBER_OF_EMPLOYEES => 'I20',
            self::NET_LOSS => 'I19',
            self::NET_PROFIT => 'I18',
            self::GROSS_LOSS => 'I17',
            self::GROSS_PROFIT => 'I16',
            self::TOTAL_EXPENSES => 'I15',
            self::TOTAL_INCOME => 'I14',
            self::NET_TURNOVER => 'I13',
            self::HERITAGE_OF_THE_KINGDOM => 'I12',
            self::PAID_SUBSCRIBED_CAPITAL => 'I11',
            self::CAPITAL_TOTAL => 'I10',
            self::PROVISIONS => 'I9',
            self::ADVANCE_INCOME => 'I8',
            self::LIABILITIES => 'I7',
            self::PREPAYMENTS => 'I6',
            self::HOME_AND_BANK_ACCOUNTS => 'I5',
            self::DEBT => 'I4',
            self::INVENTORIES => 'I3',
            self::CURRENT_ASSETS => 'I2',
            self::FIXED_ASSETS => 'I1',
        };
    }
}
