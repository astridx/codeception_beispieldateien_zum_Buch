<?php

namespace Page\Functional;

class Backend {

    // include url of current page
    public static $URL = 'http://localhost/joomla/administrator';
    public static $username = ['id' => 'mod-login-username'];
    public static $password = ['id' => 'mod-login-password'];
    public static $anmelden = 'Anmelden';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param) {
	return static::$URL . $param;
    }

    /**
     * @var \FunctionalTester;
     */
    protected $functionalTester;

    public function __construct(\FunctionalTester $I) {
	$this->functionalTester = $I;
    }

}
