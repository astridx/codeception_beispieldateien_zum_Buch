<?php

namespace suites\plugins\content\agpaypal;

class agpaypalTest extends \Codeception\Test\Unit {

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before() {
	
    }

    protected function _after() {
	
    }

    public function testOnContentPrepareIfSearchstringIsInContentOneTime() {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JEventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"', 'type' => 'content', 'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = 'Text vor der Schaltfläche.@paypalpaypal@Text hinter der Schaltfläche.';
	$contenttextafter = 'Text vor der Schaltfläche.<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post"><input type="hidden" name="amount" value="12.99"><input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit"></form>Text hinter der Schaltfläche.';
	$class->onContentPrepare('', $contenttextbefore, $params);
	$this->assertEquals($contenttextafter, $contenttextbefore);
    }

    public function testOnContentPrepareIfSearchstringIsInContentOneTimeAndContainsValueForAmount() {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JEventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"', 'type' => 'content', 'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = 'Text vor der Schaltfläche.@paypal amount=15.00 paypal@Text hinter der Schaltfläche.';
	$contenttextafter = 'Text vor der Schaltfläche.<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post"><input type="hidden" name="amount" value="15.00"><input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit"></form>Text hinter der Schaltfläche.';
	$class->onContentPrepare('', $contenttextbefore, $params);
	$this->assertEquals($contenttextafter, $contenttextbefore);
    }

    public function testOnContentPrepareIfSearchstringIsInContentOneTimeAndContainsIncorrectValueForAmount() {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JEventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"', 'type' => 'content', 'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = 'Text vor der Schaltfläche.@paypal aomunt=15.00 paypal@Text hinter der Schaltfläche.';
	$contenttextafter = 'Text vor der Schaltfläche.<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post"><input type="hidden" name="amount" value="12.99"><input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit"></form>Text hinter der Schaltfläche.';
	$class->onContentPrepare('', $contenttextbefore, $params);
	$this->assertEquals($contenttextafter, $contenttextbefore);
    }

    public function testOnContentPrepareIfSearchstringIsInContentManyTimes() {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JEventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"', 'type' => 'content', 'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = 'Text vor der Schaltfläche.@paypal amount=15.00 paypal@Text hinter der Schaltfläche. Text vor der Schaltfläche.@paypal amount=12.00 paypal@Text hinter der Schaltfläche.';
	$contenttextafter = 'Text vor der Schaltfläche.<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post"><input type="hidden" name="amount" value="15.00"><input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit"></form>Text hinter der Schaltfläche. Text vor der Schaltfläche.<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post"><input type="hidden" name="amount" value="12.00"><input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit"></form>Text hinter der Schaltfläche.';
	$class->onContentPrepare('', $contenttextbefore, $params);
	$this->assertEquals($contenttextafter, $contenttextbefore);
    }

    public function testStartCreateButtonsIfSearchstringIsInContentOneTimeAndContainsNoValue() {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JeventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"',
	    'type' => 'content',
	    'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = '<p>Texte vor der Schaltfläche.</p>'
		. '<p>@paypalpaypal@</p>'
		. '<p>Text hinter der Schaltfläche.</p>';
	$contenttextafter = '<p>Texte vor der Schaltfläche.</p>'
		. '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
		. '<input type="hidden" name="amount" value="12.99">'
		. '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
		. '</form></p>'
		. '<p>Text hinter der Schaltfläche.</p>';
	$class->startCreateButtons($contenttextbefore);
	$this->assertEquals($contenttextafter, $contenttextbefore);
    }

    // tests
    public function testDebug() {
	$test = 1;
	codecept_debug('Der Wert für Test war: ' . $test);
	$this->assertEquals($test, $test);
    }

    /**
     * @dataProvider provider_PatternToPaypalbutton
     */
    public function testStartCreateButtonsWithPattern($text) {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JeventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"',
	    'type' => 'content',
	    'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = $text['contenttextbefore'];
	$contenttextafter = $text['contenttextafter'];
	$class->startCreateButtons($contenttextbefore);
	$this->assertEquals($contenttextafter, $contenttextbefore);
    }

    public function provider_PatternToPaypalbutton() {
	return [
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal amount=16.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>'
	    . '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal amount=15.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="16.00">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>'
	    . '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="15.00">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>')],
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal aouunt=15.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="12.99">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>')],
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal amount=15.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="15.00">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>')],
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypalpaypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="12.99">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>')],
	    [array('contenttextbefore' => "jsdkl",
	    'contenttextafter' => "jsdkl")],
	    [array('contenttextbefore' => "", 'contenttextafter' => "")]
	];
    }

    /**
     * @dataProvider provider_PatternToPaypalbuttonWithHint
     */
    public function testStartCreateButtonsWithPatternWithHint($text) {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JeventDispatcher::getInstance();
	$config = array(
	    'name' => 'agpaypal"',
	    'type' => 'content',
	    'params' => new \JRegistry
	);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, $config, $params);
	$contenttextbefore = $text['contenttextbefore'];
	$hint = $text['hint'];
	$contenttextafter = $text['contenttextafter'];
	$class->startCreateButtons($contenttextbefore);
	$this->assertEquals($contenttextafter, $contenttextbefore, $hint);
    }

    public function provider_PatternToPaypalbuttonWithHint() {
	return [
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal amount=16.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>'
	    . '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal amount=15.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="16.00">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>'
	    . '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="15.00">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>', 'hint' => 'Erster Hinweis')],
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal aouunt=15.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="12.99">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>', 'hint' => 'Zweiter Hinweis')],
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypal amount=15.00 paypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="15.00">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>', 'hint' => 'Zweiter Hinweis')],
	    [array('contenttextbefore' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p>@paypalpaypal@</p>'
	    . '<p>Text hinter der Schaltfläche.</p>',
	    'contenttextafter' => '<p>Texte vor der Schaltfläche.</p>'
	    . '<p><form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
	    . '<input type="hidden" name="amount" value="12.99">'
	    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
	    . '</form></p>'
	    . '<p>Text hinter der Schaltfläche.</p>', 'hint' => 'Dritter Hinweis')],
	    [array('contenttextbefore' => "jsdkl", 
	    'contenttextafter' => "jsdkl", 'hint' => 'Ein weiterer Hinweis')],
	    [array('contenttextbefore' => "", 'contenttextafter' => "", 'hint' => 'Vierter Hinweis: Der Beitrag enthält keinen Text.')]
	];
    }

    // tests
    public function testSomeFeature() {
	
    }

}
