<?php

namespace Lib\Service\Payment\Processors;

class StripePaymentProcessor
{
    /**
     * @param int $price
     *
     * @return bool true if payment was succeeded, false otherwise
     */
    public function processPayment(int $price): bool
    {
        if ($price < 100) {
            return false;
        }

        // process payment logic
        return true;
    }
}
