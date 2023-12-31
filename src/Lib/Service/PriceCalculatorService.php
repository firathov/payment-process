<?php

namespace Lib\Service;

use Lib\Enum\CouponsTypeEnum;
use Lib\Service\Discount\DiscountInterface;
use Lib\Service\TaxCalculator\TaxCalculatorInterface;

class PriceCalculatorService
{
    public function __construct(
        private readonly TaxCalculatorInterface $taxCalculator,
        private readonly DiscountInterface $discount
    ) {
    }

    public function calculatePrice(float $productPrice, float $taxRate, ?float $discount, ?CouponsTypeEnum $discountType): float
    {
        $price = $productPrice;

        if ($discount) {
            $discountedPrice = $this->discount->applyDiscount($price, $discount, $discountType);
            $price = max(0, $discountedPrice);
        }
        $price += $this->taxCalculator->calculateTax($price, $taxRate);

        return $price;
    }
}
