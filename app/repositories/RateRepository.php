<?php

namespace App\Repositories;

use App\Models\Rates;

class RateRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Rates();
    }

}