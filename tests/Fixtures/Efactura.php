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
