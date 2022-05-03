<?php

declare(strict_types=1);

namespace App\OrderProcessor;

use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

final class CustomOrderProcessor implements OrderProcessorInterface
{
    public function process(OrderInterface $order): void
    {
    }
}
