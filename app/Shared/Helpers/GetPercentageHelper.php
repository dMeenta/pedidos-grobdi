<?php

namespace App\Shared\Helpers;

class GetPercentageHelper
{
    public static function calculate(float $part, float $total): float
    {
        return $total > 0 ? round(($part / $total) * 100, 1) : 0;
    }
}