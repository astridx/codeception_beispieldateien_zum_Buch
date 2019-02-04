<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Ich will sicherstellen, dass die Anmeldung im Administrationsbereich funktioniert.');
$I->amOnPage('http://localhost/joomla/administrator');
$I->adminLogin();
$I->see('Kontrollzentrum', ['class' => 'page-title']);