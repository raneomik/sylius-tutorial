<?php

declare(strict_types=1);

namespace App\OrderProcessor;

use App\Entity\Customer\Customer;
use App\Entity\Order\Order;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

final class OrderTaxesProcessor implements OrderProcessorInterface
{
    public function __construct(
        private OrderProcessorInterface $baseOrderProcessor
    ) {
    }

    /**
     * @param Order $order
     */
    public function process(OrderInterface $order): void
    {
        /** @var Customer $customer */
        $customer = $order->getCustomer();

        if (null !== $customer?->getTaxNumber()) {
            return;
        }

        $this->baseOrderProcessor->process($order);
    }
}
