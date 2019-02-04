<?php
define("_JEXEC", 'true');
error_reporting(E_ALL); ini_set('display_errors', 1);
define('JINSTALL_PATH','/var/www/html/joomla');
define('JPATH_LIBRARIES', JINSTALL_PATH . '/libraries');
require_once JPATH_LIBRARIES . '/import.legacy.php';
require_once JPATH_LIBRARIES . '/cms.php';
