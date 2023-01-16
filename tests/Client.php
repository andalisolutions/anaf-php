<?php

use Anaf\Resources\Info;

it('has info', function () {
    $company = Anaf::for('38744563');

    expect($company->info())->toBeInstanceOf(Info::class);
});

it('has ngo', function () {
    $company = Anaf::for('38744563');

    expect($company->ngo())->toBeInstanceOf(\Anaf\Resources\Ngo::class);
});

it('has balance sheet', function () {
    $company = Anaf::for('38744563');

    expect($company->balanceSheet())->toBeInstanceOf(\Anaf\Resources\BalanceSheet::class);
});
