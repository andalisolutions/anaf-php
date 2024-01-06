<p align="center">
    <img src="https://raw.githubusercontent.com/andalisolutions/anaf-php/main/art/social.png" width="600" alt="ANAF PHP">
    <p align="center">
        <a href="https://github.com/andalisolutions/anaf-php/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/andalisolutions/anaf-php/tests.yml?branch=main&label=tests&style=round-square"></a>
        <a href="https://packagist.org/packages/andalisolutions/anaf-php"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/andalisolutions/anaf-php"></a>
        <a href="https://packagist.org/packages/andalisolutions/anaf-php"><img alt="Latest Version" src="https://img.shields.io/packagist/v/andalisolutions/anaf-php"></a>
        <a href="https://packagist.org/packages/andalisolutions/anaf-php"><img alt="License" src="https://img.shields.io/github/license/andalisolutions/anaf-php"></a>
    </p>
</p>

------
**ANAF PHP** is a charged PHP API client that allows you to interact with the [ANAF Web Services](https://www.anaf.ro/anaf/internet/ANAF/servicii_online/servicii_web_anaf).

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

First, install ANAF via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require andalisolutions/anaf-php
```

Then, you can create `ANAF` client in two ways:

```php
/*
 * Client used for unauthenticated requests
 */
$client = Anaf::client(); 

/*
 * Client used for authenticated requests
 */ 
$authorizedClient = Anaf::authorizedClient($apiKey); 

/*
 * Build a client with a specific base URI, staging and more. Example:
 */
$factoryClient = Anaf::factory()
                        ->withApiKey($apiKey)
                        ->staging()
                        ->withBaseUri('https://webservicesp.anaf.ro')
                        ->make();  
```
#### You can obtain API key using [oauth2-anaf](https://github.com/andalisolutions/oauth2-anaf) package.
## TODO
- [x] Obtaining public information in the financial statements/annual accounting reports related to economic agents. ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/doc_WS_Bilant_V1.txt))
- [x] Get info about companies using `TAX IDENTIFICATION NUMBER` (CUI/Vat Number). ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V7.txt))
- [ ] Get info about taxpayers who are registered in the Register of farmers who apply the special regime ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/documentatie_SWRARG_v2.txt))
- [x] Get info about taxpayers who are registered in the Register of religious entities/units ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html))
- [x] Accessing the functionalities offered by the SPV ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/Prezentare_WS_SPV.txt))
- [x] The national system regarding the electronic invoice RO e-Factura ([Docs](https://mfinante.gov.ro/static/10/eFactura/prezentare%20apeluri%20API%20E-factura.pdf))
- [ ] The integrated electronic system RO e-Transport ([Docs](https://www.anaf.ro/anaf/internet/ANAF/servicii_online/servicii_web_anaf))


## Usage

### [Balance Sheet](https://static.anaf.ro/static/10/Anaf/Informatii_R/doc_WS_Bilant_V1.txt) Resource
Get public information in the financial statements/annual accounting reports related to economic agents
```php
$balanceSheet = $client()->balanceSheet()->create([
    'cui' => '12345678',
    'an' => 2019,
]);

$balanceSheet->year;
$balanceSheet->tax_identification_number;
$balanceSheet->company_name;
$balanceSheet->activity_code;
$balanceSheet->activity_name;
$balanceSheet->indicators; // array
$balanceSheet->indicators['AVERAGE_NUMBER_OF_EMPLOYEES']->value;
$balanceSheet->indicators['NET_LOSS']->value;
$balanceSheet->indicators['NET_PROFIT']->value;
$balanceSheet->indicators['GROSS_LOSS']->value;
$balanceSheet->indicators['GROSS_PROFIT']->value;
$balanceSheet->indicators['TOTAL_EXPENSES']->value;
$balanceSheet->indicators['TOTAL_INCOME']->value;
$balanceSheet->indicators['NET_TURNOVER']->value;
$balanceSheet->indicators['HERITAGE_OF_THE_KINGDOM']->value;
$balanceSheet->indicators['PAID_SUBSCRIBED_CAPITAL']->value;
$balanceSheet->indicators['CAPITAL_TOTAL']->value;
$balanceSheet->indicators['PROVISIONS']->value;
$balanceSheet->indicators['ADVANCE_INCOME']->value;
$balanceSheet->indicators['LIABILITIES']->value;
$balanceSheet->indicators['PREPAYMENTS']->value;
$balanceSheet->indicators['HOME_AND_BANK_ACCOUNTS']->value;
$balanceSheet->indicators['DEBT']->value;
$balanceSheet->indicators['INVENTORIES']->value;
$balanceSheet->indicators['CURRENT_ASSETS']->value;
$balanceSheet->indicators['FIXED_ASSETS']->value;

$balanceSheet->toArray(); // ['year' => '', 'tax_identification_number' => '', 'company_name' => '' ...]
```
_For balance sheets, the indicators may vary depending on the type of company, as specified by ANAF. I recommend you to use var_dump to observe the type of indicators. The vast majority of companies have the indicators from the example above_

### [Info](https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V8.txt) Resource

Get info about the company or multiple companies.
```php
$companyInfo = $client->info()->create([
    [
        'cui' => '12345678',
        'data' => '2021-01-01',
    ],
    [
        'cui' => '222222',
        'data' => '2021-01-01',
    ]
]);

/*
 * If you send one array, for one company, you will receive a CreateResponse object with the structure below.
 * If you send multiple arrays, for multiple companies, you will receive a CreateResponses object with an array
 * with CreateResponse objects.
 */

$companyInfo->generalData; 

/* Accessible information in general data */
$companyInfo->generalData->companyName;
$companyInfo->generalData->address;
$companyInfo->generalData->registrationNumber;
$companyInfo->generalData->phone;
$companyInfo->generalData->fax;
$companyInfo->generalData->postalCode;
$companyInfo->generalData->document;
$companyInfo->generalData->registrationStatus;
$companyInfo->generalData->registrationDate;
$companyInfo->generalData->activityCode;
$companyInfo->generalData->bankAccount;
$companyInfo->generalData->roInvoiceStatus;
$companyInfo->generalData->authorityName;
$companyInfo->generalData->formOfOwnership;
$companyInfo->generalData->organizationalForm;
$companyInfo->generalData->legalForm;

$companyInfo->vatRegistration;

/* Accessible information in vat registration */
$companyInfo->vatRegistration->status;
//vatPeriods is an array from ANAF v8
$companyInfo->vatRegistration->vatPeriods[0]->startDate
$companyInfo->vatRegistration->vatPeriods[0]->stopDate;
$companyInfo->vatRegistration->vatPeriods[0]->stopEffectiveDate;
$companyInfo->vatRegistration->vatPeriods[0]->message;

$companyInfo->vatAtCheckout;

/* Accessible information in vat at checkout */
$companyInfo->vatAtCheckout->startDate;
$companyInfo->vatAtCheckout->stopDate;
$companyInfo->vatAtCheckout->updateDate;
$companyInfo->vatAtCheckout->publishDate;
$companyInfo->vatAtCheckout->updatedType;
$companyInfo->vatAtCheckout->status;


$companyInfo->inactiveState;

/* Accessible information in inactive state */
$companyInfo->inactiveState->inactivationDate;
$companyInfo->inactiveState->reactivationDate;
$companyInfo->inactiveState->publishDate;
$companyInfo->inactiveState->deletionDate;
$companyInfo->inactiveState->status;


$companyInfo->splitVat;

/* Accessible information in split tva */
$companyInfo->splitVat->startDate;
$companyInfo->splitVat->stopDate;
$companyInfo->splitVat->status;

$companyInfo->hqAddress;

/* Accessible information in hq address */
$companyInfo->hqAddress->street;
$companyInfo->hqAddress->no;
$companyInfo->hqAddress->city;
$companyInfo->hqAddress->cityCode;
$companyInfo->hqAddress->county;
$companyInfo->hqAddress->countyCode;
$companyInfo->hqAddress->countyShort;
$companyInfo->hqAddress->country;
$companyInfo->hqAddress->details;
$companyInfo->hqAddress->postalCode;

$companyInfo->fiscalAddress;

/* Accessible information in fiscal address */
$companyInfo->fiscalAddress->street;
$companyInfo->fiscalAddress->no;
$companyInfo->fiscalAddress->city;
$companyInfo->fiscalAddress->cityCode;
$companyInfo->fiscalAddress->county;
$companyInfo->fiscalAddress->countyCode;
$companyInfo->fiscalAddress->countyShort;
$companyInfo->fiscalAddress->country;
$companyInfo->fiscalAddress->details;
$companyInfo->fiscalAddress->postalCode;

// You can use all resources as array
$companyInfo->toArray(); // ["general_data" => ["tax_identification_number" => '', "company_name" => ''...]..]
// or
$companyInfo->generalData->toArray(); // ['tax_identification_number' => '', 'company_name' => ''...]


```
### [Ngo](https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html) Resource

Checking NGO taxpayers who are registered in the Register of religious entities/units
```php
$entityInfo = $client->ngo()->create([
    [
        'cui' => '12345678',
        'data' => '2021-01-01',
    ]
]);

$entityInfo->taxIdentificationNumber;
$entityInfo->searchDate;
$entityInfo->entityName;
$entityInfo->address;
$entityInfo->phone;
$entityInfo->postalCode;
$entityInfo->document;
$entityInfo->registrationStatus;
$entityInfo->startDate;
$entityInfo->endDate;
$entityInfo->status;

// You can use all resources as array
$entityInfo->toArray(); // ["tax_identification_number" => '', "entity_name" => ''...]

```

### [eFactura](https://mfinante.gov.ro/web/efactura/informatii-tehnice) Resource

#### [Upload](https://mfinante.gov.ro/static/10/eFactura/upload.html) Resource
TODO: implement `upload` from [here](hhttps://mfinante.gov.ro/static/10/eFactura/upload.html)

#### [Status](https://mfinante.gov.ro/static/10/eFactura/upload.html) Resource
TODO: implement `status` from [here](https://mfinante.gov.ro/static/10/eFactura/staremesaj.html)

#### [Messages](https://mfinante.gov.ro/static/10/eFactura/listamesaje.html) Resource
TODO: implement `paginated messages` from [here](https://mfinante.gov.ro/static/10/eFactura/listamesaje.html#/EFacturaListaMesaje/getPaginatie)
Get the list of available messages
```php
$spvMessages = $authorizedClient->efactura()->messages([
    'zile' => 30, // between 1 and 60
    'cif' => '12345678',
]);

$spvMessages->messages; // array
$spvMessages->serial;
$spvMessages->taxIdentificationNumbers;
$spvMessages->title;

$message = $spvMessages->messages[0];
$message->creationDate,
$message->taxIdentificationNumber,
$message->solicitationId,
$message->details,
$message->type,
$message->id,
```

#### [Download - eFactura XML](https://mfinante.gov.ro/static/10/eFactura/descarcare.html) Resource
Get a file from the SPV identified by the `id` received from the messages endpoint
```php
$file = $authorizedClient->efactura()->download([
    'id' => '12345678',
]);

$file->getContent(); // string - You can save/download the content to a file
```
#### [Validate](https://mfinante.gov.ro/static/10/eFactura/validare.html) Resource
TODO: implement `validate` from [here](https://mfinante.gov.ro/static/10/eFactura/validare.html)

#### [XmlToPdf](https://mfinante.gov.ro/static/10/eFactura/xmltopdf.html) Resource
Convert XML eFactura to PDF. For this endpoint you need to use unauthenticated client
```php
/*
 * $xmlStandard can be one of the following: 'FACT1', 'FCN'. 
 * The default value is 'FACT1'
 */
$file = $client->efactura()->xmlToPdf($pathToXmlFile, $xmlStandard);
$file->getContent(); // string - You can save the pdf content to a file
```

TODO: implement `/transformare/{standard}/{novld}` from [here](https://mfinante.gov.ro/static/10/eFactura/xmltopdf.html#/EFacturaXmlToPdf/getPdfNoVld)

---

ANAF PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
