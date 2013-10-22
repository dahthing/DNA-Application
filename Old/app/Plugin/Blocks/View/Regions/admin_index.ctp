<?php
$this->extend('/Common/admin_index');
$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Blocks'), array('plugin' => 'blocks', 'controller' => 'blocks', 'action' => 'index'))
	->addCrumb(__d('dna', 'Regions'), '/' . $this->request->url);
?>
