<?php

DnaCache::config('dna_blocks', array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('blocks'))
));

Dna::hookComponent('*', array(
	'Blocks.Blocks' => array(
		'priority' => 5,
	)
));

Dna::hookHelper('*', 'Blocks.Regions');

DnaNav::add('blocks', array(
	'icon' => 'glyphicons show_thumbnails',
	'title' => __d('dna', 'Blocks'),
	'url' => array(
		'plugin' => 'blocks',
		'admin' => true,
		'controller' => 'blocks',
		'action' => 'index',
	),
	'weight' => 30,
	'children' => array(
		'blocks' => array(
			'title' => __d('dna', 'Blocks'),
			'url' => array(
				'plugin' => 'blocks',
				'admin' => true,
				'controller' => 'blocks',
				'action' => 'index',
			),
		),
		'regions' => array(
			'title' => __d('dna', 'Regions'),
			'url' => array(
				'plugin' => 'blocks',
				'admin' => true,
				'controller' => 'regions',
				'action' => 'index',
			),
		),
	),
));
