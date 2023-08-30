<?php

namespace Lib\Service\Payment;

interface PaymentProcessorInterface
{
    public function processPayment(int $price): bool;
}
