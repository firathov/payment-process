<?php

namespace Lib\Service\TaxCalculator;

interface TaxCalculatorInterface
{
    public function calculateTax(float $price, string $taxRate): float;
}
