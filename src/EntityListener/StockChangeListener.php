<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Product\ProductVariant;
use App\Sender\LowInventorySender;
use Doctrine\Persistence\Event\LifecycleEventArgs;

final class StockChangeListener
{
    public function __construct(
        private LowInventorySender $lowInventorySender
    ) {
    }

    public function postUpdate(ProductVariant $productVariant): void
    {
        $stock = $productVariant->getOnHand() - $productVariant->getOnHold();

        if (5 < $stock) {
            return;
        }

        $this->lowInventorySender->send($productVariant);
    }
}
