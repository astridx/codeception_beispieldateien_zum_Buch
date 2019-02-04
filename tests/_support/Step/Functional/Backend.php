<?php

namespace Step\Functional;

use Page\Functional\Backend as BackendPage;

class Backend extends \FunctionalTester {
    /*    public function login() {
      $I = $this;
      $I->fillField(['id' => 'mod-login-username'], 'admin');
      $I->fillField(['id' => 'mod-login-password'], 'admin');
      $I->click('Anmelden');
      } */

    public function login() {
	$I = $this;
	$I->fillField(BackendPage::$username, 'admin');
	$I->fillField(BackendPage::$password, 'admin');
	$I->click(BackendPage::$anmelden);
    }

}
