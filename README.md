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

Then, interact with ANAF's API:

```php
$company = Anaf::for('TAX IDENTIFICATION NUMBER');
```

## TODO
- [ ] Obtaining public information in the financial statements/annual accounting reports related to economic agents. ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/doc_WS_Bilant_V1.txt))
- [x] Get info about taxpayers who are registered according to art. 316 of the Fiscal Code, according to the Register of taxable persons who apply the VAT system upon receipt, according to the Register of inactive/reactive taxpayers, according to the Register of persons who apply the broken down payment of VAT and respectively the RO e-Invoice Register. ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V7.txt))
- [ ] Get info about taxpayers who are registered in the Register of farmers who apply the special regime ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/documentatie_SWRARG_v2.txt))
- [x] Get info about taxpayers who are registered in the Register of religious entities/units ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html))
- [ ] Accessing the functionalities offered by the SPV ([Docs](https://static.anaf.ro/static/10/Anaf/Informatii_R/Prezentare_WS_SPV.txt))
- [ ] The national system regarding the electronic invoice RO e-Factura ([Docs](https://mfinante.gov.ro/static/10/eFactura/prezentare%20apeluri%20API%20E-factura.pdf))
- [ ] The integrated electronic system RO e-Transport ([Docs](https://www.anaf.ro/anaf/internet/ANAF/servicii_online/servicii_web_anaf))


## Usage

### [Balance Sheet](https://static.anaf.ro/static/10/Anaf/Informatii_R/doc_WS_Bilant_V1.txt) Resource
Get public information in the financial statements/annual accounting reports related to economic agents
```php
$balanceSheet = $company->balanceSheet()->forYear('2021');
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
$balanceSheet->indicators['HOME_AND_BANK_ACCOUNTS']-value;
$balanceSheet->indicators['DEBT']-value;
$balanceSheet->indicators['INVENTORIES']-value;
$balanceSheet->indicators['CURRENT_ASSETS']-value;
$balanceSheet->indicators['FIXED_ASSETS']->value;

$balanceSheet->toArray(); // ['year' => '', 'tax_identification_number' => '', 'company_name' => '' ...]
```

### [Info](https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V7.txt) Resource

Checking taxpayers who are registered according to art. 316 of the Fiscal Code in Romania, according to the Register of taxable persons who apply the VAT system upon receipt, according to the Register of inactive/reactive taxpayers, according to the Register of persons who apply the broken down payment of VAT and respectively the RO e-Invoice Register.
```php
$companyInfo = $company->info()->get();

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

$companyInfo->vatRegistration;

/* Accessible information in vat registration */
$companyInfo->vatRegistration->status;
$companyInfo->vatRegistration->startDate;
$companyInfo->vatRegistration->stopDate;
$companyInfo->vatRegistration->stopEffectiveDate;
$companyInfo->vatRegistration->message;

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
$entity = Anaf::for('TAX IDENTIFICATION NUMBER');

$entityInfo = $entity->ngo()->get();

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
---

ANAF PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
