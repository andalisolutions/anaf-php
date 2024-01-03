<?php

/**
 * @return array<string, mixed>
 */
function getNgoInfo(): array
{
    return [
        'tax_identification_number' => 123446,
        'search_date' => '2023-01-01',
        'entity_name' => 'ASOCIATIA TEST',
        'address' => 'Campulung',
        'phone' => '0700000000',
        'postal_code' => '115100',
        'document' => 'DOSAR 1/1/2023',
        'registration_status' => 'INREGISTRAT din data 14.01.2023',
        'start_date' => '2023-01-14',
        'end_date' => ' ',
        'status' => true,
    ];
}

/**
 * @return array<string, mixed>
 */
function getNgoAnafInfo(): array
{
    return [
        'cod' => 200,
        'message' => 'SUCCESS',
        'found' => [
            [
                'cui' => 123446,
                'data' => '2023-01-01',
                'denumire' => 'ASOCIATIA TEST',
                'adresa' => 'Campulung',
                'telefon' => '0700000000',
                'codPostal' => '115100',
                'act' => 'DOSAR 1/1/2023',
                'stare_inregistrare' => 'INREGISTRAT din data 14.01.2023',
                'dataInceputRegCult' => '2023-01-14',
                'dataAnulareRegCult' => ' ',
                'statusRegCult' => true,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function getMultipleNgoAnafInfo(): array
{
    return [
        'cod' => 200,
        'message' => 'SUCCESS',
        'found' => [
            [
                'cui' => 123446,
                'data' => '2023-01-01',
                'denumire' => 'ASOCIATIA TEST',
                'adresa' => 'Campulung',
                'telefon' => '0700000000',
                'codPostal' => '115100',
                'act' => 'DOSAR 1/1/2023',
                'stare_inregistrare' => 'INREGISTRAT din data 14.01.2023',
                'dataInceputRegCult' => '2023-01-14',
                'dataAnulareRegCult' => ' ',
                'statusRegCult' => true,
            ],
            [
                'cui' => 123446,
                'data' => '2023-01-01',
                'denumire' => 'ASOCIATIA TEST',
                'adresa' => 'Campulung',
                'telefon' => '0700000000',
                'codPostal' => '115100',
                'act' => 'DOSAR 1/1/2023',
                'stare_inregistrare' => 'INREGISTRAT din data 14.01.2023',
                'dataInceputRegCult' => '2023-01-14',
                'dataAnulareRegCult' => ' ',
                'statusRegCult' => true,
            ],
        ],
    ];
}
