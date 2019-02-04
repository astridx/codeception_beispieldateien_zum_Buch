<?php

namespace Step\Acceptance;

class Paypal extends \AcceptanceTester {

    /**
     * @Given There is a add content link
     */
    public function thereIsAAddContentLink() {
	$I = $this;
	$I->amOnPage("/administrator/index.php?option=com_content&view=articles");
	$I->click(['xpath' => "//div[@id='toolbar-new']//button"]);
    }

    /**
     * @When I create new content with field title as :arg1 and content as a :arg2
     */
    public function iCreateNewContentWithFieldTitleAsAndContentAsA($title, $content) {
	$I = $this;
	$I->fillField(['id' => 'jform_title'], $title);
	$I->scrollTo(['css' => 'div.toggle-editor']);
	$I->click("Editor an/aus");
	$I->fillField(['id' => 'jform_articletext'], $content);
    }

    /**
     * @When I save an article
     */
    public function iSaveAnArticle() {
	$I = $this;
	$I->click(['xpath' => "//div[@id='toolbar-apply']//button"]);
    }

    /**
     * @Then I should see the article :arg1 is created
     */
    public function iShouldSeeTheArticleIsCreated($item) {
	$I = $this;
	$I->see('Der Beitrag wurde gespeichert!', ['id' => 'system-message-container']);
    }

    /**
     * @When I login into Joomla administrator
     */
    public function iLoginIntoJoomlaAdministrator() {
	$I = $this;
	$I->amOnPage("/administrator/index.php");
	$I->fillField(['id' => 'mod-login-username'], 'admin');
	$I->fillField(['id' => 'mod-login-password'], 'admin');
	$I->click(['xpath' => "//button[contains(normalize-space(), 'Anmelden')]"]);
    }

    /**
     * @When I see the administrator dashboard
     */
    public function iSeeTheAdministratorDashboard() {
	$I = $this;
	$I->waitForText('Kontrollzentrum');
	$I->see('Kontrollzentrum', ['class' => 'page-title']);
    }

    /**
     * @Given I am on home page
     */
     public function iAmOnHomePage(){
		$I = $this;
		$I->amOnPage("/index.php");
     }
}    

