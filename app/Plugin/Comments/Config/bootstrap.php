<?php

DnaCache::config('dna_comments', array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('comments'))
));

Dna::hookHelper('*', 'Comments.Comments');

DnaNav::add('content.children.comments', array(
	'title' => __d('dna', 'Comments'),
	'url' => array(
		'admin' => true,
		'plugin' => 'comments',
		'controller' => 'comments',
		'action' => 'index',
	),
	'children' => array(
		'published' => array(
			'title' => __d('dna', 'Published'),
			'url' => array(
				'admin' => true,
				'plugin' => 'comments',
				'controller' => 'comments',
				'action' => 'index',
				'?' => array(
					'status' => '1',
				),
			),
		),
		'approval' => array(
			'title' => __d('dna', 'Approval'),
			'url' => array(
				'admin' => true,
				'plugin' => 'comments',
				'controller' => 'comments',
				'action' => 'index',
				'?' => array(
					'status' => '0',
				),
			),
		),
	),
));
