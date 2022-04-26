<?php

namespace App\Tests\Behat\Contexts\Ui;

use App\Tests\Behat\Pages\Newsletter\IndexPage;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

class NewsletterContext implements Context
{
    public function __construct(
        private IndexPage $indexPage
    ) {
    }

    /**
     * @When  /^I go to newsletter list$/
     */
    public function IGoToIndexPage(): void
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see there is :amount newsletter in the list
     */
    public function ISeeAmount(int $amount): void
    {
        Assert::eq($amount, $this->indexPage->countItems());
    }

    /**
     * @Then /^there should be a newsletter "([^"]*)"$/
     */
    public function thereShouldBeNewsletter(string $name)
    {
        Assert::inArray($name, $this->indexPage->getColumnFields('name'));
    }
}
