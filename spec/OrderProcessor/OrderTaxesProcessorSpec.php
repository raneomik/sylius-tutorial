<?php

declare(strict_types=1);

namespace spec\App\OrderProcessor;

use App\Entity\Customer\Customer;
use App\Entity\Order\Order;
use App\OrderProcessor\OrderTaxesProcessor;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

class OrderTaxesProcessorSpec extends ObjectBehavior
{
    public function let(OrderProcessorInterface $baseOrderProcessor)
    {
        $this->beConstructedWith($baseOrderProcessor);
    }

    public function it_must_implement_order_processor_interface(): void
    {
        $this->shouldImplement(OrderProcessorInterface::class);
    }

    public function it_must_be_correct_type(): void
    {
        $this->shouldBeAnInstanceOf(OrderTaxesProcessor::class);
    }

    public function it_must_process_order_tax_without_customer(
        OrderProcessorInterface $baseOrderProcessor,
        Order $order,
    ): void {
        $order->getCustomer()->willReturn(null);

        $baseOrderProcessor->process($order)->shouldBeCalled();

        $this->process($order);
    }

    public function it_must_process_order_tax_for_customer_without_taw_number(
        OrderProcessorInterface $baseOrderProcessor,
        Order $order,
        Customer $customer,
    ): void {
        $customer->getTaxNumber()->willReturn(null);
        $order->getCustomer()->willReturn($customer);

        $baseOrderProcessor->process($order)->shouldBeCalled();

        $this->process($order);
    }

    public function it_must_not_process_order_tax_for_customer_with_tax_number(
        OrderProcessorInterface $baseOrderProcessor,
        Order $order,
        Customer $customer,
    ): void {
        $customer->getTaxNumber()->willReturn('12345');
        $order->getCustomer()->willReturn($customer);

        $baseOrderProcessor->process($order)->shouldNotBeCalled();

        $this->process($order);
    }
}
