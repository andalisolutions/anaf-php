<?php

/**
 * @return array<string, mixed>
 */
function getBalanceSheet(): array
{
    return [
        'year' => 2019,
        'tax_identification_number' => 38744563,
        'company_name' => 'ANDALI SOLUTIONS PRO SRL',
        'activity_code' => 6201,
        'activity_name' => 'Activitati de realizare a soft-ului la comanda (software orientat client)',
        'indicators' => [
            'AVERAGE_NUMBER_OF_EMPLOYEES' => [
                'indicator' => 'I20',
                'value' => 1,
                'indicator_name' => 'Numar mediu de salariati',
            ],
            'NET_LOSS' => [
                'indicator' => 'I19',
                'value' => 0,
                'indicator_name' => 'Pierdere  neta',
            ],
            'NET_PROFIT' => [
                'indicator' => 'I18',
                'value' => 67840,
                'indicator_name' => 'Profit net',
            ],
            'GROSS_LOSS' => [
                'indicator' => 'I17',
                'value' => 0,
                'indicator_name' => 'Pierdere bruta',
            ],
            'GROSS_PROFIT' => [
                'indicator' => 'I16',
                'value' => 69591,
                'indicator_name' => 'Profit brut',
            ],
            'TOTAL_EXPENSES' => [
                'indicator' => 'I15',
                'value' => 111403,
                'indicator_name' => 'CHELTUIELI TOTALE',
            ],
            'TOTAL_INCOME' => [
                'indicator' => 'I14',
                'value' => 180994,
                'indicator_name' => 'VENITURI TOTALE',
            ],
            'NET_TURNOVER' => [
                'indicator' => 'I13',
                'value' => 174962,
                'indicator_name' => 'Cifra de afaceri neta',
            ],
            'HERITAGE_OF_THE_KINGDOM' => [
                'indicator' => 'I12',
                'value' => 0,
                'indicator_name' => 'Patrimoniul regiei',
            ],
            'PAID_SUBSCRIBED_CAPITAL' => [
                'indicator' => 'I11',
                'value' => 1000,
                'indicator_name' => 'Capital subscris varsat',
            ],
            'CAPITAL_TOTAL' => [
                'indicator' => 'I10',
                'value' => 95302,
                'indicator_name' => 'CAPITALURI - TOTAL, din care:',
            ],
            'PROVISIONS' => [
                'indicator' => 'I9',
                'value' => 0,
                'indicator_name' => 'PROVIZIOANE',
            ],
            'ADVANCE_INCOME' => [
                'indicator' => 'I8',
                'value' => 95708,
                'indicator_name' => 'VENITURI IN AVANS',
            ],
            'LIABILITIES' => [
                'indicator' => 'I7',
                'value' => 4088,
                'indicator_name' => 'DATORII ',
            ],
            'PREPAYMENTS' => [
                'indicator' => 'I6',
                'value' => 0,
                'indicator_name' => 'CHELTUIELI IN AVANS',
            ],
            'HOME_AND_BANK_ACCOUNTS' => [
                'indicator' => 'I5',
                'value' => 148913,
                'indicator_name' => 'Casa si conturi la banci',
            ],
            'DEBT' => [
                'indicator' => 'I4',
                'value' => 13480,
                'indicator_name' => 'Creante',
            ],
            'INVENTORIES' => [
                'indicator' => 'I3',
                'value' => 25148,
                'indicator_name' => 'Stocuri',
            ],
            'CURRENT_ASSETS' => [
                'indicator' => 'I2',
                'value' => 187541,
                'indicator_name' => 'ACTIVE CIRCULANTE - TOTAL, din care:',
            ],
            'FIXED_ASSETS' => [
                'indicator' => 'I1',
                'value' => 7557,
                'indicator_name' => 'ACTIVE IMOBILIZATE - TOTAL ',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function getAnafBalanceSheet(): array
{
    return [
        'an' => 2019,
        'cui' => 38744563,
        'deni' => 'ANDALI SOLUTIONS PRO SRL',
        'caen' => 6201,
        'den_caen' => 'Activitati de realizare a soft-ului la comanda (software orientat client)',
        'i' => [
            [
                'indicator' => 'I20',
                'val_indicator' => 1,
                'val_den_indicator' => 'Numar mediu de salariati',
            ],
            [
                'indicator' => 'I19',
                'val_indicator' => 0,
                'val_den_indicator' => 'Pierdere  neta',
            ],
            [
                'indicator' => 'I18',
                'val_indicator' => 67840,
                'val_den_indicator' => 'Profit net',
            ],
            [
                'indicator' => 'I17',
                'val_indicator' => 0,
                'val_den_indicator' => 'Pierdere bruta',
            ],
            [
                'indicator' => 'I16',
                'val_indicator' => 69591,
                'val_den_indicator' => 'Profit brut',
            ],
            [
                'indicator' => 'I15',
                'val_indicator' => 111403,
                'val_den_indicator' => 'CHELTUIELI TOTALE',
            ],
            [
                'indicator' => 'I14',
                'val_indicator' => 180994,
                'val_den_indicator' => 'VENITURI TOTALE',
            ],
            [
                'indicator' => 'I13',
                'val_indicator' => 174962,
                'val_den_indicator' => 'Cifra de afaceri neta',
            ],
            [
                'indicator' => 'I12',
                'val_indicator' => 0,
                'val_den_indicator' => 'Patrimoniul regiei',
            ],
            [
                'indicator' => 'I11',
                'val_indicator' => 1000,
                'val_den_indicator' => 'Capital subscris varsat',
            ],
            [
                'indicator' => 'I10',
                'val_indicator' => 95302,
                'val_den_indicator' => 'CAPITALURI - TOTAL, din care:',
            ],
            [
                'indicator' => 'I9',
                'val_indicator' => 0,
                'val_den_indicator' => 'PROVIZIOANE',
            ],
            [
                'indicator' => 'I8',
                'val_indicator' => 95708,
                'val_den_indicator' => 'VENITURI IN AVANS',
            ],
            [
                'indicator' => 'I7',
                'val_indicator' => 4088,
                'val_den_indicator' => 'DATORII ',
            ],
            [
                'indicator' => 'I6',
                'val_indicator' => 0,
                'val_den_indicator' => 'CHELTUIELI IN AVANS',
            ],
            [
                'indicator' => 'I5',
                'val_indicator' => 148913,
                'val_den_indicator' => 'Casa si conturi la banci',
            ],
            [
                'indicator' => 'I4',
                'val_indicator' => 13480,
                'val_den_indicator' => 'Creante',
            ],
            [
                'indicator' => 'I3',
                'val_indicator' => 25148,
                'val_den_indicator' => 'Stocuri',
            ],
            [
                'indicator' => 'I2',
                'val_indicator' => 187541,
                'val_den_indicator' => 'ACTIVE CIRCULANTE - TOTAL, din care:',
            ],
            [
                'indicator' => 'I1',
                'val_indicator' => 7557,
                'val_den_indicator' => 'ACTIVE IMOBILIZATE - TOTAL ',
            ],
        ],
    ];
}
