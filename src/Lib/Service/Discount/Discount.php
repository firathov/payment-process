<?php

namespace Lib\Service\Discount;

use Lib\Enum\CouponsTypeEnum;

class Discount implements DiscountInterface
{
    public function applyDiscount(float $price, float $discount, CouponsTypeEnum $discountType): float
    {
        if ($discountType === CouponsTypeEnum::Percent) {
            $discount = $discount / 100;
            $discountedAmount = $price - $price * $discount;
        } else {
            $discountedAmount = $price - $discount;
        }

        return $discountedAmount;
    }
}
