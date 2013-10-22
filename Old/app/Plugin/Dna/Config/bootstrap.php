<?php

App::uses('CakeLog', 'Log');
App::uses('DnaPlugin', 'Extensions.Lib');
App::uses('DnaEventManager', 'Dna.Event');
App::uses('Dna', 'Dna.Lib');
App::uses('DnaNav', 'Dna.Lib');

CakePlugin::load(array('Extensions'), array('bootstrap' => true));
require_once 'dna_bootstrap.php';

if (Configure::read('Dna.installed')) {
	return;
}

// Load Install plugin
if (Configure::read('Security.salt') == 'f78b12a5c38e9e5c6ae6fbd0ff1f46c77a1e3' ||
	Configure::read('Security.cipherSeed') == '60170779348589376') {
	$_securedInstall = false;
}
Configure::write('Install.secured', !isset($_securedInstall));
Configure::write('Install.installed',
	file_exists(APP . 'Config' . DS . 'database.php') &&
	file_exists(APP . 'Config' . DS . 'settings.json') &&
	file_exists(APP . 'Config' . DS . 'dna.php')
);
if (!Configure::read('Install.installed') || !Configure::read('Install.secured')) {
	CakePlugin::load('Install', array('routes' => true));
}