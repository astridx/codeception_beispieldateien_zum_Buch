<?php

defined('_JEXEC') or die;

class PlgContentAgpaypal extends JPlugin {

    public function onContentPrepare($context, &$row, $params, $page = 0) {
	if (is_object($row)) {
	    $this->startCreateButtons($row->text);
	} else {
	    $this->startCreateButtons($row);
	}
	return true;
    }

    public function startCreateButtons(&$text) {
	preg_match_all('/@paypal(.*?)paypal@/i', $text, $matches, PREG_PATTERN_ORDER);
	if ((count($matches[0]) > 0)) {
	    $this->createButtons($matches, $text);
	}
	return true;
    }

    public function createButtons($matches, &$text) {
	for ($i = 0; $i < count($matches[0]); $i++) {
	    $search = $matches[0][$i];
	    if ((strpos($matches[1][$i], 'amount=') !== false) > 0) {
		$amount = trim(str_replace('amount=', '', $matches[1][$i]));
	    } else {
		$amount = '12.99';
	    }
	    $replace = '<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post">'
		    . '<input type="hidden" name="amount" value="' . $amount . '">'
		    . '<input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit">'
		    . '</form>';
	    $text = str_replace($search, $replace, $text);
	}
	return true;
    }

}
