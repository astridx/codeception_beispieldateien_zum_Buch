<?php

defined('_JEXEC') or die;

class plgContentAgpaypal extends JPlugin {

    public function onContentPrepare($context, &$row, $params, $page = 0) {
	$search = "@paypalpaypal@";
	$replace = '<form name="_xclick"action="https://www.paypal.com/de/cgi-bin/webscr" method="post"><input type="hidden" name="amount" value="12.99"><input type="image"src="http://www.paypal.com/de_DE/i/btn/x-click-but01.gif" border="0" name="submit"></form>';

	if (is_object($row)) {
	    $row->text = str_replace($search, $replace, $row->text);
	} else {
	$row = str_replace($search, $replace, $row);
    
	}

	return true;
    }

}
