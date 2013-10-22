<?php

if (Configure::read('Site.acl_plugin') == 'Acl') {

	// activate AclFilter component only until after a succesful install
	if (file_exists(APP . 'Config' . DS . 'settings.json')) {
		Dna::hookComponent('*', 'Acl.AclFilter');
		Dna::hookComponent('*', array(
			'DnaAccess' => array(
				'className' => 'Acl.AclAccess',
			),
		));
	}

	Dna::hookBehavior('User', 'Acl.UserAro');
	Dna::hookBehavior('Role', 'Acl.RoleAro');

	DnaNav::add('users.children.permissions', array(
		'title' => __d('dna', 'Permissions'),
		'url' => array(
			'admin' => true,
			'plugin' => 'acl',
			'controller' => 'acl_permissions',
			'action' => 'index',
		),
		'weight' => 30,
	));

	DnaNav::add('settings.children.acl', array(
		'title' => __d('dna', 'Access Control'),
		'url' => array(
			'admin' => true,
			'plugin' => 'settings',
			'controller' => 'settings',
			'action' => 'prefix',
			'Access Control',
		),
	));

	Cache::config('permissions', array(
		'duration' => '+1 hour',
		'path' => CACHE . 'queries' . DS,
		'engine' => Configure::read('Cache.defaultEngine'),
		'prefix' => Configure::read('Cache.defaultPrefix'),
		'groups' => array('acl')
	));
}
