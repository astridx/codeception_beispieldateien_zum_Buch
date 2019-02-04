<?php
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendGET('http://localhost/joomla/index.php?option=com_users');
$I->see('Benutzername');
$I->see('Passwort');