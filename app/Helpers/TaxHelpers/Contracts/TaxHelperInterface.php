<?php

namespace App\Helpers\TaxHelpers\Contracts;

interface TaxHelperInterface
{
    public function getTypeName();
    public function getRefundable();
    public function getTaxValue();
    public function getAmount();
}