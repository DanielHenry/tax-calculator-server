<?php

namespace App\Helpers\TaxHelpers;

use App\Helpers\TaxHelpers\Contracts\TaxHelperInterface;

class Tobacco implements TaxHelperInterface
{
    public function getTypeName()
    {
        return 'Tobacco';
    }

    public function getRefundable()
    {
        return FALSE;
    }

    public function getTaxValue($price = 0)
    {
        return (floatval($price) * 2.0 / 100.0) + 10.0;
    }

    public function getAmount($price = 0)
    {
        return floatval($price) + $this->getTaxValue($price);
    }
}