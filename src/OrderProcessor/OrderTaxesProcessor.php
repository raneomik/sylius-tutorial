<?php

declare(strict_types=1);

namespace App\OrderProcessor;

use App\Entity\Customer\Customer;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

final class OrderTaxesProcessor implements OrderProcessorInterface
{
    public function __construct(
        private readonly OrderProcessorInterface $baseOrderProcessor
    ) {
    }

    /**
     * @psalm-ignore MoreSpecificImplementedParamType
     * @phpstan-param Order $order
     */
    public function process(OrderInterface|Order $order): void
    {
        /**
         * @var ?Customer $customer
         */
        $customer = $order->getCustomer();

        if (null !== $customer?->getTaxNumber()) {
            return;
        }

        $this->baseOrderProcessor->process($order);
    }
}
