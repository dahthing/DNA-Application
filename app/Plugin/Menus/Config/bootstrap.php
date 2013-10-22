<?php

DnaCache::config('dna_menus', array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('menus'))
));

Dna::hookComponent('*', 'Menus.Menus');

Dna::hookHelper('*', 'Menus.Menus');

DnaNav::add('menus', array(
	'icon' => 'glyphicons show_thumbnails_with_lines',
	'title' => __d('dna', 'Menus'),
	'url' => array(
		'plugin' => 'menus',
		'admin' => true,
		'controller' => 'menus',
		'action' => 'index',
	),
	'weight' => 20,
	'children' => array(
		'menus' => array(
			'title' => __d('dna', 'Menus'),
			'url' => array(
				'plugin' => 'menus',
				'admin' => true,
				'controller' => 'menus',
				'action' => 'index',
			),
			'weight' => 10,
		),
		'add_new' => array(
			'title' => __d('dna', 'Add new'),
			'url' => array(
				'plugin' => 'menus',
				'admin' => true,
				'controller' => 'menus',
				'action' => 'add',
			),
			'weight' => 20,
			'htmlAttributes' => array('class' => 'separator'),
		),
	),
));
