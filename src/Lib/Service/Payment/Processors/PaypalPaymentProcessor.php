<?php

namespace Lib\Service\Payment\Processors;

use Exception;

class PaypalPaymentProcessor
{
    /**
     * @param int $price
     *
     * @throws Exception in case of a failed payment
     */
    public function pay(int $price): void
    {
        if ($price > 100000) {
            throw new Exception('Too high price');
        }

        // process payment logic
    }
}
