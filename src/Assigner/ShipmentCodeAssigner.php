<?php

declare(strict_types=1);

namespace App\Assigner;

use App\Entity\Shipping\Shipment;
use App\Provider\ShipmentCodeProvider;
use Doctrine\Persistence\ObjectManager;

class ShipmentCodeAssigner
{
    public function __construct(
        private ObjectManager $shipmentManager,
        private ShipmentCodeProvider $shipmentCodeProvider,
    ) {
    }

    public function assign(Shipment $shipment): void
    {
        if (Shipment::STATE_SHIPPED !== $shipment->getState()) {
            return;
        }

        $code = $this->shipmentCodeProvider->provide();
        $shipment->setTracking($code);

        $this->shipmentManager->flush();
    }
}
