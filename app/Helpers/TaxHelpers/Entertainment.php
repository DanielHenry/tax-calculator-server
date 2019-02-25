<?php

namespace App\Helpers\TaxHelpers;

use App\Helpers\TaxHelpers\Contracts\TaxHelperInterface;

class Entertainment implements TaxHelperInterface
{
    public function getTypeName()
    {
        return 'Entertainment';
    }

    public function getRefundable()
    {
        return FALSE;
    }

    public function getTaxValue($price = 0)
    {
        if ($price >= 100) {
            return floatval($price-100) * 1.0 / 100.0;
        } else {
            return 0.0;
        }
    }

    public function getAmount($price = 0)
    {
        return floatval($price) + $this->getTaxValue($price);
    }
}