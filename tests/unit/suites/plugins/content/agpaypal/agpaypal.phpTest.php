<?php

namespace suites\plugins\content\agpaypal;

use \Codeception\Util\Fixtures;
use \Codeception\Util\Stub;
use \Codeception\Verify;

class agpaypalTest extends \Codeception\Test\Unit {

    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $class;
    protected $row;
    protected $params;

    protected function _before() {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JeventDispatcher::getInstance();
	Fixtures::add('config', [
	    'name' => 'agpaypal″', 'type' => 'content', 'params' => new \JRegistry
	]);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$this->class = new \PlgContentAgpaypal($subject, Fixtures::get('config'), $params);
	$this->row = $this->getMockBuilder(\stdClass::class)->getMock();
	$this->params = $this->getMockBuilder(JRegistry::class)->getMock();
	$this->rowForStub = Stub::make('stdClass');
	$this->paramsForStub = Stub::make('JRegistry');
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

    // Data Provider
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

    // Fixtures
    /**
     * @dataProvider provider_PatternToPaypalbuttonWithHint
     */
    public function testStartCreateButtonsWithPatternWithHintAndFixture($text) {
	require_once JINSTALL_PATH . '/libraries/joomla/event/dispatcher.php';
	$subject = \JeventDispatcher::getInstance();
	/* $config = array(
	  'name' => 'agpaypal"',
	  'type' => 'content',
	  'params' => new \JRegistry
	  ); */
	Fixtures::add('config', [
	    'name' => 'agpaypal', 'type' => 'content', 'params' => new \JRegistry
	]);
	$params = new \JRegistry;
	require_once JINSTALL_PATH . '/plugins/content/agpaypal/agpaypal.php';
	$class = new \PlgContentAgpaypal($subject, Fixtures::get('config'), $params);
	$contenttextbefore = $text['contenttextbefore'];
	$hint = $text['hint'];
	$contenttextafter = $text['contenttextafter'];
	$class->startCreateButtons($contenttextbefore);
	$this->assertEquals($contenttextafter, $contenttextbefore, $hint);
    }

    // Use _before()-Methode
    /**
     * @dataProvider provider_PatternToPaypalbuttonWithHint
     */
    public function testStartCreateButtonsWithPatternWithHintAndFixtureAndBeforeMethode($text) {
	$contenttextbefore = $text['contenttextbefore'];
	$contenttextafter = $text['contenttextafter'];
	$hint = $text['hint'];
	$this->class->startCreateButtons($contenttextbefore);
	$this->assertEquals($contenttextafter, $contenttextbefore, $hint);
    }

    // Stub 1
    public function testOnContentPrepareWithMock() {
	$returnValue = $this->class->onContentPrepare('', $this->row, $this->params);
	$this->assertTrue($returnValue);
    }

    // Stub 2 (Codeception)
    public function testOnContentPrepareWithMockFromCodeception() {
	$returnValue = $this->class->onContentPrepare('', $this->rowForStub, $this->paramsForStub);
	codecept_debug('testOnContentPrepareWithMockFromCodeception: ' . json_encode($this->rowForStub));
	$this->assertTrue($returnValue);
    }

    // Mock
    public function testOnContentPrepareMethodRunsOneTime() {
	$myplugin = $this->getMockBuilder(\ PlgContentAgpaypal::class)
		->disableOriginalConstructor()
		->setMethods(['startCreateButtons'])
		->getMock();
	$myplugin->expects($this->once())->method('startCreateButtons');
	$myplugin->onContentPrepare('', $this->row, $this->params);
    }

    // Mock 2 (never)
    public function testOnContentPrepareMethodRunsNever() {
	$myplugin = $this->getMockBuilder(\ PlgContentAgpaypal::class)
		->disableOriginalConstructor()
		->setMethods(['startCreateButtons'])
		->getMock();
	$myplugin->expects($this->never())->method('startCreateButtons');
	//$myplugin->onContentPrepare('', $this->row, $this->params);
    }

    public function testOnContentPrepareMethodRunsOneTimeSpecify() {
	$this->specify("Die Method startCreateButtons wird ausgeführt wenn der Beitragstext als Eigenschaft eines Objektes vorkommt.", function() {
	    $myplugin = $this->getMockBuilder(\PlgContentAgpaypal::class)
		    ->disableOriginalConstructor()
		    ->setMethods(['startCreateButtons'])
		    ->getMock();
	    $myplugin->expects($this->once())->method('startCreateButtons');
	    $myplugin->onContentPrepare('', $this->row, $this->params);
	});
	$this->specify("Die Method startCreateButtons wird ausgeführt wenn der Beitragstext als reiner Text vorkommt.", function() {
	    $myplugin = $this->getMockBuilder(\PlgContentAgpaypal::class)
		    ->disableOriginalConstructor()
		    ->setMethods(['startCreateButtons'])
		    ->getMock();
	    $myplugin->expects($this->once())->method('startCreateButtons');
	    $text = 'Text des Beitrages';
	    $myplugin->onContentPrepare('', $text, $this->params);
	});
    }

    /**
     * @dataProvider provider_PatternToPaypalbuttonWithHint
     */
    public function testStartCreateButtonsSpecify($text) {
	$this->specify("Wandelt den Text @paypalpaypal@ in eine PayPalschaltfläche um, wenn er einmal im Beitragstext vorhanden ist.", function($text) {
	    $contenttextbefore = $text['contenttextbefore'];
	    $contenttextafter = $text['contenttextafter'];
	    $hint = $text['hint'];
	    $this->class->startCreateButtons($contenttextbefore);
	    $this->assertEquals($contenttextafter, $contenttextbefore, $hint);
	}, ['examples' => $this->provider_PatternToPaypalbuttonWithHint()]);
    }

    /**
     * @dataProvider provider_PatternToPaypalbuttonWithHint
     */
    public function testStartCreateButtonsVerify($text) {
	$this->specify("Wandelt den Text @paypalpaypal@ in eine PayPalschaltfläche um, wenn er einmal im Beitragstext vorhanden ist.", function($text) {
	    $contenttextbefore = $text['contenttextbefore'];
	    $contenttextafter = $text['contenttextafter'];
	    $hint = $text['hint'];
	    $this->class->startCreateButtons($contenttextbefore);
	    // $this->assertEquals($contenttextafter, $contenttextbefore, $hint);
	    verify($contenttextafter)->equals($contenttextbefore);
	}, ['examples' => $this->provider_PatternToPaypalbuttonWithHint()]);
    }

    // tests
    public function testSomeFeature() {
	
    }

}
