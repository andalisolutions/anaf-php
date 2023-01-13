<?php

use Anaf\Resources\Info;

it('has info', function () {
    $company = Anaf::for('38744563');

    expect($company->info())->toBeInstanceOf(Info::class);
});
