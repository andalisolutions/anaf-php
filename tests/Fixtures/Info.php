<?php

/**
 * @return array<string, mixed>
 */
function getCompanyInfo(): array
{
    return [
        'general_data' => [
            'tax_identification_number' => 38744563,
            'search_date' => date('Y-m-d'),
            'company_name' => 'ANDALI SOLUTIONS PRO S.R.L.',
            'address' => 'JUD. ARGEŞ, SAT LEREŞTI COM. LEREŞTI, STR. ŞOTCAN, NR.940, ET.PARTER',
            'registration_number' => 'J03/176/2018',
            'phone' => '',
            'fax' => '',
            'postal_code' => '117430',
            'document' => '',
            'registration_status' => 'INREGISTRAT din data 25.01.2018',
            'registration_date' => '2018-01-25',
            'activity_code' => '6201',
            'bank_account' => '',
            'ro_invoice_status' => false,
            'authority_name' => 'Serviciul Fiscal Municipal Câmpulung',
            'form_of_ownership' => 'PROPR.PRIVATA-CAPITAL PRIVAT AUTOHTON',
            'organizational_form' => 'PERSOANA JURIDICA',
            'legal_form' => 'SOCIETATE COMERCIALĂ CU RĂSPUNDERE LIMITAT',
        ],
        'vat_registration' => [
            'status' => true,
            'vat_periods' => [
                [
                    'start_date' => '2023-01-25',
                    'stop_date' => '',
                    'stop_effective_date' => '',
                    'message' => '',
                ],
            ],
        ],
        'vat_at_checkout' => [
            'start_date' => '',
            'stop_date' => '',
            'update_date' => '',
            'publish_date' => '',
            'updated_type' => '',
            'status' => false,
        ],
        'inactive_state' => [
            'inactivation_date' => '',
            'reactivation_date' => '',
            'publish_date' => '',
            'deletion_date' => '',
            'status' => false,
        ],
        'split_vat' => [
            'start_date' => '',
            'stop_date' => '',
            'status' => false,
        ],
        'hq_address' => [
            'street' => 'Str. Şotcan',
            'no' => '940',
            'city' => 'Sat Lereşti Com. Lereşti',
            'city_code' => '338',
            'county' => 'ARGEŞ',
            'county_code' => '3',
            'county_short' => 'AG',
            'country' => '',
            'details' => '',
            'postalCode' => '117430',
        ],
        'fiscal_address' => [
            'street' => 'Str. Şotcan',
            'no' => '940',
            'city' => 'Sat Lereşti Com. Lereşti',
            'city_code' => '338',
            'county' => 'ARGEŞ',
            'county_code' => '3',
            'county_short' => 'AG',
            'country' => '',
            'details' => '',
            'postalCode' => '117430',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function getCompanyAnafInfo(): array
{
    return [
        'cod' => 200,
        'message' => 'SUCCESS',
        'found' => [
            0 => [
                'date_generale' => [
                    'cui' => 38744563,
                    'data' => date('Y-m-d'),
                    'denumire' => 'ANDALI SOLUTIONS PRO S.R.L.',
                    'adresa' => 'JUD. ARGEŞ, SAT LEREŞTI COM. LEREŞTI, STR. ŞOTCAN, NR.940, ET.PARTER',
                    'nrRegCom' => 'J03/176/2018',
                    'telefon' => '',
                    'fax' => '',
                    'codPostal' => '117430',
                    'act' => '',
                    'stare_inregistrare' => 'INREGISTRAT din data 25.01.2018',
                    'data_inregistrare' => '2018-01-25',
                    'cod_CAEN' => '6201',
                    'iban' => '',
                    'statusRO_e_Factura' => false,
                    'organFiscalCompetent' => 'Serviciul Fiscal Municipal Câmpulung',
                    'forma_de_proprietate' => 'PROPR.PRIVATA-CAPITAL PRIVAT AUTOHTON',
                    'forma_organizare' => 'PERSOANA JURIDICA',
                    'forma_juridica' => 'SOCIETATE COMERCIALĂ CU RĂSPUNDERE LIMITAT',
                ],
                'inregistrare_scop_Tva' => [
                    'scpTVA' => true,
                    'perioade_TVA' => [
                        0 => [
                            'data_inceput_ScpTVA' => '2023-01-25',
                            'data_sfarsit_ScpTVA' => '',
                            'data_anul_imp_ScpTVA' => '',
                            'mesaj_ScpTVA' => '',
                        ],
                    ],
                ],
                'inregistrare_RTVAI' => [
                    'dataInceputTvaInc' => '',
                    'dataSfarsitTvaInc' => '',
                    'dataActualizareTvaInc' => '',
                    'dataPublicareTvaInc' => '',
                    'tipActTvaInc' => '',
                    'statusTvaIncasare' => false,
                ],
                'stare_inactiv' => [
                    'dataInactivare' => '',
                    'dataReactivare' => '',
                    'dataPublicare' => '',
                    'dataRadiere' => '',
                    'statusInactivi' => false,
                ],
                'inregistrare_SplitTVA' => [
                    'dataInceputSplitTVA' => '',
                    'dataAnulareSplitTVA' => '',
                    'statusSplitTVA' => false,
                ],
                'adresa_sediu_social' => [
                    'sdenumire_Strada' => 'Str. Şotcan',
                    'snumar_Strada' => '940',
                    'sdenumire_Localitate' => 'Sat Lereşti Com. Lereşti',
                    'scod_Localitate' => '338',
                    'sdenumire_Judet' => 'ARGEŞ',
                    'scod_Judet' => '3',
                    'scod_JudetAuto' => 'AG',
                    'stara' => '',
                    'sdetalii_Adresa' => '',
                    'scod_Postal' => '117430',
                ],
                'adresa_domiciliu_fiscal' => [
                    'ddenumire_Strada' => 'Str. Şotcan',
                    'dnumar_Strada' => '940',
                    'ddenumire_Localitate' => 'Sat Lereşti Com. Lereşti',
                    'dcod_Localitate' => '338',
                    'ddenumire_Judet' => 'ARGEŞ',
                    'dcod_Judet' => '3',
                    'dcod_JudetAuto' => 'AG',
                    'dtara' => '',
                    'ddetalii_Adresa' => '',
                    'dcod_Postal' => '117430',
                ],
            ],
        ],
        'notFound' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function getMultipleCompanyAnafInfo(): array
{
    return [
        'cod' => 200,
        'message' => 'SUCCESS',
        'found' => [
            0 => [
                'date_generale' => [
                    'cui' => 38744563,
                    'data' => date('Y-m-d'),
                    'denumire' => 'ANDALI SOLUTIONS PRO S.R.L.',
                    'adresa' => 'JUD. ARGEŞ, SAT LEREŞTI COM. LEREŞTI, STR. ŞOTCAN, NR.940, ET.PARTER',
                    'nrRegCom' => 'J03/176/2018',
                    'telefon' => '',
                    'fax' => '',
                    'codPostal' => '117430',
                    'act' => '',
                    'stare_inregistrare' => 'INREGISTRAT din data 25.01.2018',
                    'data_inregistrare' => '2018-01-25',
                    'cod_CAEN' => '6201',
                    'iban' => '',
                    'statusRO_e_Factura' => false,
                    'organFiscalCompetent' => 'Serviciul Fiscal Municipal Câmpulung',
                    'forma_de_proprietate' => 'PROPR.PRIVATA-CAPITAL PRIVAT AUTOHTON',
                    'forma_organizare' => 'PERSOANA JURIDICA',
                    'forma_juridica' => 'SOCIETATE COMERCIALĂ CU RĂSPUNDERE LIMITAT',
                ],
                'inregistrare_scop_Tva' => [
                    'scpTVA' => true,
                    'perioade_TVA' => [
                        0 => [
                            'data_inceput_ScpTVA' => '2023-01-25',
                            'data_sfarsit_ScpTVA' => '',
                            'data_anul_imp_ScpTVA' => '',
                            'mesaj_ScpTVA' => '',
                        ],
                    ],
                ],
                'inregistrare_RTVAI' => [
                    'dataInceputTvaInc' => '',
                    'dataSfarsitTvaInc' => '',
                    'dataActualizareTvaInc' => '',
                    'dataPublicareTvaInc' => '',
                    'tipActTvaInc' => '',
                    'statusTvaIncasare' => false,
                ],
                'stare_inactiv' => [
                    'dataInactivare' => '',
                    'dataReactivare' => '',
                    'dataPublicare' => '',
                    'dataRadiere' => '',
                    'statusInactivi' => false,
                ],
                'inregistrare_SplitTVA' => [
                    'dataInceputSplitTVA' => '',
                    'dataAnulareSplitTVA' => '',
                    'statusSplitTVA' => false,
                ],
                'adresa_sediu_social' => [
                    'sdenumire_Strada' => 'Str. Şotcan',
                    'snumar_Strada' => '940',
                    'sdenumire_Localitate' => 'Sat Lereşti Com. Lereşti',
                    'scod_Localitate' => '338',
                    'sdenumire_Judet' => 'ARGEŞ',
                    'scod_Judet' => '3',
                    'scod_JudetAuto' => 'AG',
                    'stara' => '',
                    'sdetalii_Adresa' => '',
                    'scod_Postal' => '117430',
                ],
                'adresa_domiciliu_fiscal' => [
                    'ddenumire_Strada' => 'Str. Şotcan',
                    'dnumar_Strada' => '940',
                    'ddenumire_Localitate' => 'Sat Lereşti Com. Lereşti',
                    'dcod_Localitate' => '338',
                    'ddenumire_Judet' => 'ARGEŞ',
                    'dcod_Judet' => '3',
                    'dcod_JudetAuto' => 'AG',
                    'dtara' => '',
                    'ddetalii_Adresa' => '',
                    'dcod_Postal' => '117430',
                ],
            ],
            1 => [
                'date_generale' => [
                    'cui' => 123456789,
                    'data' => date('Y-m-d'),
                    'denumire' => 'TEST S.R.L.',
                    'adresa' => 'JUD. ARGEŞ, SAT LEREŞTI COM. LEREŞTI, STR. ŞOTCAN, NR.940, ET.PARTER',
                    'nrRegCom' => 'J03/176/2018',
                    'telefon' => '',
                    'fax' => '',
                    'codPostal' => '117430',
                    'act' => '',
                    'stare_inregistrare' => 'INREGISTRAT din data 25.01.2018',
                    'data_inregistrare' => '2018-01-25',
                    'cod_CAEN' => '6201',
                    'iban' => '',
                    'statusRO_e_Factura' => false,
                    'organFiscalCompetent' => 'Serviciul Fiscal Municipal Câmpulung',
                    'forma_de_proprietate' => 'PROPR.PRIVATA-CAPITAL PRIVAT AUTOHTON',
                    'forma_organizare' => 'PERSOANA JURIDICA',
                    'forma_juridica' => 'SOCIETATE COMERCIALĂ CU RĂSPUNDERE LIMITAT',
                ],
                'inregistrare_scop_Tva' => [
                    'scpTVA' => true,
                    'perioade_TVA' => [
                        0 => [
                            'data_inceput_ScpTVA' => '2023-01-25',
                            'data_sfarsit_ScpTVA' => '',
                            'data_anul_imp_ScpTVA' => '',
                            'mesaj_ScpTVA' => '',
                        ],
                    ],
                ],
                'inregistrare_RTVAI' => [
                    'dataInceputTvaInc' => '',
                    'dataSfarsitTvaInc' => '',
                    'dataActualizareTvaInc' => '',
                    'dataPublicareTvaInc' => '',
                    'tipActTvaInc' => '',
                    'statusTvaIncasare' => false,
                ],
                'stare_inactiv' => [
                    'dataInactivare' => '',
                    'dataReactivare' => '',
                    'dataPublicare' => '',
                    'dataRadiere' => '',
                    'statusInactivi' => false,
                ],
                'inregistrare_SplitTVA' => [
                    'dataInceputSplitTVA' => '',
                    'dataAnulareSplitTVA' => '',
                    'statusSplitTVA' => false,
                ],
                'adresa_sediu_social' => [
                    'sdenumire_Strada' => 'Str. Şotcan',
                    'snumar_Strada' => '940',
                    'sdenumire_Localitate' => 'Sat Lereşti Com. Lereşti',
                    'scod_Localitate' => '338',
                    'sdenumire_Judet' => 'ARGEŞ',
                    'scod_Judet' => '3',
                    'scod_JudetAuto' => 'AG',
                    'stara' => '',
                    'sdetalii_Adresa' => '',
                    'scod_Postal' => '117430',
                ],
                'adresa_domiciliu_fiscal' => [
                    'ddenumire_Strada' => 'Str. Şotcan',
                    'dnumar_Strada' => '940',
                    'ddenumire_Localitate' => 'Sat Lereşti Com. Lereşti',
                    'dcod_Localitate' => '338',
                    'ddenumire_Judet' => 'ARGEŞ',
                    'dcod_Judet' => '3',
                    'dcod_JudetAuto' => 'AG',
                    'dtara' => '',
                    'ddetalii_Adresa' => '',
                    'dcod_Postal' => '117430',
                ],
            ],
        ],
        'notFound' => [],
    ];
}
