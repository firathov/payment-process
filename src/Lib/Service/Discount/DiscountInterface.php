<?php

namespace Lib\Service\Discount;

use Lib\Enum\CouponsTypeEnum;

interface DiscountInterface {
    public function applyDiscount(float $price, float $discount, CouponsTypeEnum $discountType): float;
}
