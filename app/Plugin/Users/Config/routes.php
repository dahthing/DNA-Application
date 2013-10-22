<?php

// Users
DnaRouter::connect('/register', array('plugin' => 'users', 'controller' => 'users', 'action' => 'add'));

DnaRouter::connect('/user/:username', array(
	'plugin' => 'users', 'controller' => 'users', 'action' => 'view'), array('pass' => array('username')
));
