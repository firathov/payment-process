<?php

namespace Lib\Service\Payment\Adapter;

use Exception;
use Lib\Service\Payment\PaymentProcessorInterface;
use Lib\Service\Payment\Processors\PaypalPaymentProcessor;

class PaypalPaymentProcessorAdapter implements PaymentProcessorInterface
{
    public function __construct(
        private readonly PaypalPaymentProcessor $paypalPaymentProcessor
    ) {
    }

    public function processPayment(int $price): bool
    {
        try {
            $this->paypalPaymentProcessor->pay($price);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
