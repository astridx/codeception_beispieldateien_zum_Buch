<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Ich will sicherstellen, dass eine PayPal Schaltfläche angezeigt wird.');
$I->amOnPage('http://localhost/joomla');
$I->seeInFormFields('form[name=_xclick]', [
     'amount' => '12.99',
]);