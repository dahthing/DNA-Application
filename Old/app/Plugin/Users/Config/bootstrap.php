<?php

/**
 * Failed login attempts
 *
 * Default is 5 failed login attempts in every 5 minutes
 */
$cacheConfig = array_merge(
	Configure::read('Cache.defaultConfig'),
	array('groups' => array('users'))
);
$failedLoginDuration = 300;
Configure::write('User.failed_login_limit', 5);
Configure::write('User.failed_login_duration', $failedLoginDuration);
DnaCache::config('users_login', array_merge($cacheConfig, array(
	'duration' => '+' . $failedLoginDuration . ' seconds',
	'groups' => array('users'),
)));

DnaNav::add('users', array(
	'icon' => 'glyphicons group',
	'title' => __d('dna', 'Users'),
	'url' => array(
		'admin' => true,
		'plugin' => 'users',
		'controller' => 'users',
		'action' => 'index',
	),
	'weight' => 50,
	'children' => array(
		'users' => array(
			'title' => __d('dna', 'Users'),
			'url' => array(
				'admin' => true,
				'plugin' => 'users',
				'controller' => 'users',
				'action' => 'index',
			),
			'weight' => 10,
		),
		'roles' => array(
			'title' => __d('dna', 'Roles'),
			'url' => array(
				'admin' => true,
				'plugin' => 'users',
				'controller' => 'roles',
				'action' => 'index',
			),
			'weight' => 20,
		),
	),
));
