<?php

declare(strict_types=1);

namespace spec\App\Entity;

use App\Entity\Newsletter;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;

class NewsletterSpec extends ObjectBehavior
{
    public function it_must_implement_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    public function it_must_be_correct_type(): void
    {
        $this->shouldBeAnInstanceOf(Newsletter::class);
    }

    public function it_has_name(): void
    {
        $this->setName('Name');
        $this->getName()->shouldReturn('Name');
    }
}
