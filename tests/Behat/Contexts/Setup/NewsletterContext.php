<?php

namespace App\Tests\Behat\Contexts\Setup;

use App\Entity\Newsletter;
use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class NewsletterContext implements Context
{
    public function __construct(
        private RepositoryInterface $newsletterRepository,
        private FactoryInterface $newsletterFactory,
    ) {
    }

    /**
     * @Given there is a newsletter named :name
     */
    public function thereIsANewsletterNamed(string $name): void
    {
        /** @var Newsletter $newsletter */
        $newsletter = $this->newsletterFactory->createNew();
        $newsletter->setName($name);

        $this->newsletterRepository->add($newsletter);
    }
}
