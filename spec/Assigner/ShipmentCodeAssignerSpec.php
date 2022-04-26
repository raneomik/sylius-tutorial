<?php

declare(strict_types=1);

namespace spec\App\Assigner;

use App\Assigner\ShipmentCodeAssigner;
use App\Entity\Shipping\Shipment;
use App\Provider\ShipmentCodeProvider;
use Doctrine\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;

class ShipmentCodeAssignerSpec extends ObjectBehavior
{
    public function let(ObjectManager $shipmentManager, ShipmentCodeProvider $shipmentCodeProvider): void
    {
        $this->beConstructedWith($shipmentManager, $shipmentCodeProvider);
    }

    public function it_is_a_shipment_code_assigner(): void
    {
        $this->shouldBeAnInstanceOf(ShipmentCodeAssigner::class);
    }

    public function it_assigns_shipment_code(
        ObjectManager $shipmentManager,
        ShipmentCodeProvider $shipmentCodeProvider,
        Shipment $shipment,
    ): void {
        $testCode = '12345';

        $shipment->getState()->willReturn(Shipment::STATE_SHIPPED);
        $shipmentCodeProvider->provide()->willReturn($testCode);

        $shipment->setTracking($testCode)->shouldBeCalled();
        $shipmentManager->flush()->shouldBeCalled();

        $this->assign($shipment);
    }

    public function it_does_not_assign_shipment_code(
        ObjectManager $shipmentManager,
        ShipmentCodeProvider $shipmentCodeProvider,
        Shipment $shipment,
    ): void {
        $testCode = '12345';

        $shipment->getState()->willReturn(Shipment::STATE_CART);
        $shipmentCodeProvider->provide()->willReturn($testCode);

        $shipmentCodeProvider->provide()->shouldNotBeCalled();

        $this->assign($shipment);
    }
}
