<?php

namespace Lib\Service\TaxCalculator;

class TaxCalculator implements TaxCalculatorInterface
{
    public function calculateTax(float $price, string $taxRate): float
    {
        return $price * $taxRate;
    }
}
