<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\TaxHelpers\TaxHelper;

class Tax extends Model
{
    public static function getComplete($tax)
    {
        $code = intval($tax->tax_code);
        $price = intval($tax->price);
        $taxTypeInstance = TaxHelper::getInstance($code);
        $result = [
            'name' => $tax->name,
            'taxCode' => $code,
            'type' => $taxTypeInstance->getTypeName(),
            'refundable' => $taxTypeInstance->getRefundable(),
            'price' => $price,
            'tax' => $taxTypeInstance->getTaxValue($price),
            'amount' => $taxTypeInstance->getAmount($price),
        ];
        return $result;
    }
}
