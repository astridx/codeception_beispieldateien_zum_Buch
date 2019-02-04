<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Ich will sicherstellen, dass das Formular funktioniert.');
//$I->amOnPage('http://localhost/beispiel/index.html');
$I->amOnPage('http://localhost/joomla/plugins/content/agpaypal/index.html');
$I->sendPOST(
    'http://localhost/joomla/plugins/content/agpaypal/action.php',
//    'http://localhost/beispiel/action.php',
    [ 'name' => 'Peter', ]);
$I->see('Hello Peter');