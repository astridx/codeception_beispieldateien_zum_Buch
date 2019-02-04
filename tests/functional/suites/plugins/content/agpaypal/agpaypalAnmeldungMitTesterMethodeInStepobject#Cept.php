<?php
use Step\Functional\Backend as AdminTester;
$I = new AdminTester($scenario);
$I->wantTo('Ich will sicherstellen, dass die Anmeldung im Administrationsbereich funktioniert.');
$I->amOnPage('http://localhost/joomla/administrator');
$I->login();
$I->see('Kontrollzentrum', ['class' => 'page-title']);