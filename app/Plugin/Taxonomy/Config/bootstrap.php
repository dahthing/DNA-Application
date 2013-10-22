<?php

$cacheConfig = array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('taxonomy'))
);
DnaCache::config('dna_types', $cacheConfig);
DnaCache::config('dna_vocabularies', $cacheConfig);

Dna::hookComponent('*', 'Taxonomy.Taxonomies');

Dna::hookHelper('*', 'Taxonomy.Taxonomies');

DnaNav::add('settings.children.content_types', array(
	'title' => __d('dna', 'Content Types'),
	'url' => array(
		'plugin' => 'taxonomy',
		'admin' => true,
		'controller' => 'types',
		'action' => 'index',
	),
	'weight' => 30,
));

DnaNav::add('content.children.taxonomy', array(
	'title' => __d('dna', 'Taxonomy'),
	'url' => array(
		'plugin' => 'taxonomy',
		'admin' => true,
		'controller' => 'vocabularies',
		'action' => 'index',
	),
	'weight' => 40,
	'children' => array(
		'list' => array(
			'title' => __d('dna', 'List'),
				'url' => array(
				'plugin' => 'taxonomy',
				'admin' => true,
				'controller' => 'vocabularies',
				'action' => 'index',
			),
			'weight' => 10,
		),
		'add_new' => array(
			'title' => __d('dna', 'Add new'),
			'url' => array(
				'plugin' => 'taxonomy',
				'admin' => true,
				'controller' => 'vocabularies',
				'action' => 'add',
			),
			'weight' => 20,
			'htmlAttributes' => array('class' => 'separator'),
		)
	)
));
