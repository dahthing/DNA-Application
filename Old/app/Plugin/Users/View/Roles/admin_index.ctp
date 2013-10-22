<?php
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('dna', 'Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'))
	->addCrumb(__d('dna', 'Roles'), '/' . $this->request->url);
