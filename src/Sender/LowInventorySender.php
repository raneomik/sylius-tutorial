<?php

declare(strict_types=1);

namespace App\Sender;

use App\Emails;
use App\Entity\Channel\Channel;
use App\Entity\Product\ProductVariant;
use Sylius\Component\Mailer\Sender\SenderInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class LowInventorySender
{
    public function __construct(
        private SenderInterface $sender,
        private RepositoryInterface $channelRepository
    ) {
    }

    public function send(ProductVariant $productVariant): void
    {
        $recipients = [];

        /** @var Channel[] $channels */
        $channels = $this->channelRepository->findAll();

        foreach ($channels as $channel) {
            if (null === ($contactEmail = $channel->getContactEmail())) {
                continue;
            }

            $recipients[] = $contactEmail;
        }

        if (empty($recipients)) {
            return;
        }

        $this->sender->send(
            Emails::LOW_INVENTORY,
            $recipients,
            [
                'channel' => $channel,
                'localeCode' => $channel->getDefaultLocale()->getCode(),
                'productVariant' => $productVariant,
            ]
        );
    }
}
