<?php

namespace Lib\Service\Payment\Adapter;

use Lib\Service\Payment\PaymentProcessorInterface;
use Lib\Service\Payment\Processors\StripePaymentProcessor;

class StripePaymentProcessorAdapter implements PaymentProcessorInterface
{
    public function __construct(
        private readonly StripePaymentProcessor $stripePaymentProcessor
    ) {
    }

    public function processPayment(int $price): bool
    {
        return $this->stripePaymentProcessor->processPayment($price);
    }
}
