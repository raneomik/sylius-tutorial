@managing_newsletter
Feature: In order to manage newsletters
    As an administrator
    I want to access the list of newsletters

    Background:
        Given I am logged in as an administrator
        And there is a newsletter named "Newsletter 1"

    @ui
    Scenario:
        When I go to newsletter list
        Then I should see there is 1 newsletter in the list
        And there should be a newsletter "Newsletter 1"
