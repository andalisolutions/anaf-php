<?php

namespace Anaf\Enums\BalanceSheet;

enum Indicator: string
{
    case I20 = 'Numar mediu de salariati';
    case I19 = 'Pierdere neta';
    case I18 = 'Profit net';
    case I17 = 'Pierdere bruta';
    case I16 = 'Profit brut';
    case I15 = 'CHELTUIELI TOTALE';
    case I14 = 'VENITURI TOTALE';
    case I13 = 'Cifra de afaceri neta';
    case I12 = 'Patrimoniul regiei';
    case I11 = 'Capital subscris varsat';
    case I10 = 'CAPITALURI - TOTAL, din care:';
    case I9 = 'PROVIZIOANE';
    case I8 = 'VENITURI IN AVANS';
    case I7 = 'DATORII ';
    case I6 = 'CHELTUIELI IN AVANS';
    case I5 = 'Casa şi conturi la bănci';
    case I4 = 'Creante';
    case I3 = 'Stocuri';
    case I2 = 'ACTIVE CIRCULANTE - TOTAL, din care:';
    case I1 = 'ACTIVE IMOBILIZATE - TOTAL';
}
