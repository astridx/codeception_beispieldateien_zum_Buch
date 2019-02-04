Feature: paypal
  In order to manage content articles with paypal links
  I need to create a content article with a paypal link

  Background:
    When I login into Joomla administrator
    And I see the administrator dashboard

  Scenario: Create an Article
    Given There is a add content link
    When I create new content with field title as "Beitrag mit PayPal-Button" and content as a "Dies ist mein erster Beitrag."
    And I save an article
    Then I should see the article "Beitrag mit PayPal-Button" is created
  
  Scenario: Show an Article
    Given I am on home page