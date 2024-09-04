<?php

use Anaf\ValueObjects\Transporter\FileHandler;

/**
 * @return array<string, mixed>
 */
function getEfacturaMessages(): array
{
    return [
        'mesaje' => [
            [
                'data_creare' => '202211011415',
                'cif' => '8000000000',
                'id_solicitare' => '5001130147',
                'detalii' => 'Erori de validare identificate la factura primita cu id_incarcare=5001130147',
                'tip' => 'ERORI FACTURA',
                'id' => '3001293434',
            ],
            [
                'data_creare' => '202211011336',
                'cif' => '8000000000',
                'id_solicitare' => '5001131297',
                'detalii' => 'Factura cu id_incarcare=5001131297 emisa de cif_emitent=8000000000 pentru cif_beneficiar=3',
                'tip' => 'FACTURA TRIMISA',
                'id' => '3001503294',
            ],
        ],
        'serial' => '1234AA456',
        'cui' => '8000000000',
        'titlu' => 'Lista Mesaje disponibile din ultimele 1 zile',
    ];

}

/**
 * @return array<string, mixed>
 */
function getEfacturaPaginatedMessages(): array
{
    return [
        'mesaje' => [
            [
                'data_creare' => '202211011415',
                'cif' => '8000000000',
                'id_solicitare' => '5001130147',
                'detalii' => 'Erori de validare identificate la factura primita cu id_incarcare=5001130147',
                'tip' => 'ERORI FACTURA',
                'id' => '3001293434',
            ],
            [
                'data_creare' => '202211011336',
                'cif' => '8000000000',
                'id_solicitare' => '5001131297',
                'detalii' => 'Factura cu id_incarcare=5001131297 emisa de cif_emitent=8000000000 pentru cif_beneficiar=3',
                'tip' => 'FACTURA TRIMISA',
                'id' => '3001503294',
            ],
        ],
        'numar_inregistrari_in_pagina' => 2,
        'numar_total_inregistrari_per_pagina' => 500,
        'numar_total_inregistrari' => 14130,
        'numar_total_pagini' => 29,
        'index_pagina_curenta' => 29,
        'serial' => '1234AA456',
        'cui' => '8000000000',
        'titlu' => 'Lista Mesaje disponibile din intervalul 06-09-2022 09:48:20 - 02-11-2022 11:49:24',
    ];

}

function getUploadMessage(): array
{
    return [
        '@attributes' => [
            'dateResponse' => '202108051140',
            'ExecutionStatus' => '0',
            'index_incarcare' => '3828',
        ],
    ];
}

function getFakeFile(string $content = 'dummy zile file content')
{
    return new FileHandler($content);
}

/**
 * @return array<string, string>
 */
function getXmlSignatureValidationMessages(): array
{
    return [
        'msg' => 'Fișierele încărcate NU au putut fi validate cu succes, din perspectiva autenticității semnăturii aplicate și a apartenenței acesteia la XML-ul ce reprezintă factura electronică. Documentul factură de tip XML cu semnătura de validare atașată, NU poate fi considerat document original din perspectiva legislativă și NU este generat prin intermediul sistemului național RO e-Factura.',
    ];

}
