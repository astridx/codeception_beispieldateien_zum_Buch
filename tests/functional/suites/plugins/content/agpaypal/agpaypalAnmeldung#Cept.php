<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Ich will sicherstellen, dass die Anmeldung im Administrationsbereich funktioniert.');
$I->amOnPage('http://localhost/joomla/administrator');
$I->fillField(['id' => 'mod-login-username'], 'admin');
$I->fillField(['id' => 'mod-login-password'], 'admin');
$I->click('Anmelden');
$I->see('Kontrollzentrum', ['class' => 'page-title']);