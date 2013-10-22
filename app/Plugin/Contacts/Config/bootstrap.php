<?php

DnaCache::config('contacts_view', array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('contacts'))
));

DnaNav::add('contacts', array(
	'icon' => 'glyphicons envelope',
	'title' => __d('dna', 'Contacts'),
	'url' => array(
		'admin' => true,
		'plugin' => 'contacts',
		'controller' => 'contacts',
		'action' => 'index',
	),
	'weight' => 50,
	'children' => array(
		'contacts' => array(
			'title' => __d('dna', 'Contacts'),
			'url' => array(
				'admin' => true,
				'plugin' => 'contacts',
				'controller' => 'contacts',
				'action' => 'index',
			),
		),
		'messages' => array(
			'title' => __d('dna', 'Messages'),
			'url' => array(
				'admin' => true,
				'plugin' => 'contacts',
				'controller' => 'messages',
				'action' => 'index',
			),
		),
	),
));

