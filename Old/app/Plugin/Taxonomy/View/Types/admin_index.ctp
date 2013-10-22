<?php
$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('dna', 'Types'), '/' . $this->request->url);

echo $this->extend('/Common/admin_index');
?>
