<?php

namespace App\Helpers\TaxHelpers;

use App\Helpers\TaxHelpers\Food;
use App\Helpers\TaxHelpers\Tobacco;
use App\Helpers\TaxHelpers\Entertainment;

class TaxHelper
{
    public static function getInstance($taxCode = 1)
    {
        $instance = NULL;
        switch ($taxCode) {
            case 1:
                $instance = new Food();
                break;
            case 2:
                $instance = new Tobacco();
                break;
            case 3:
                $instance = new Entertainment();
                break;
            default:
                $instance = new Food();
                break;
        }
        return $instance;
    }
}