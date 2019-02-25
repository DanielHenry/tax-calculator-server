<?php

namespace App\Helpers\TaxHelpers;

use App\Helpers\TaxHelpers\Contracts\TaxHelperInterface;

class Food implements TaxHelperInterface
{
    public function getTypeName()
    {
        return 'Food & Beverage';
    }

    public function getRefundable()
    {
        return TRUE;
    }

    public function getTaxValue($price = 0)
    {
        return floatval($price) / 10.0;
    }

    public function getAmount($price = 0)
    {
        return floatval($price) + $this->getTaxValue($price);
    }
}