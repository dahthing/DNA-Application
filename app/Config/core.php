<?php

if (file_exists(APP . 'Config' . DS . 'dna.php')) {
	require APP . 'Config' . DS . 'dna.php';
} else {
	if (!defined('LOG_ERROR')) {
		define('LOG_ERROR', LOG_ERR);
	}

	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));
}
