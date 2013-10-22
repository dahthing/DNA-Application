<?php

DnaNav::add('media', array(
	'icon' => 'glyphicons picture',
	'title' => __d('dna', 'Media'),
	'url' => array(
		'admin' => true,
		'plugin' => 'file_manager',
		'controller' => 'attachments',
		'action' => 'index',
	),
	'weight' => 40,
	'children' => array(
		'attachments' => array(
			'title' => __d('dna', 'Attachments'),
			'url' => array(
				'admin' => true,
				'plugin' => 'file_manager',
				'controller' => 'attachments',
				'action' => 'index',
			),
		),
		'file_manager' => array(
			'title' => __d('dna', 'File Manager'),
			'url' => array(
				'admin' => true,
				'plugin' => 'file_manager',
				'controller' => 'file_manager',
				'action' => 'browse',
			),
		),
	),
));
