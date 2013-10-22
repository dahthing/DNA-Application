<?php

$this->extend('/Common/admin_index');
$this->Html
	->addCrumb('', '/admin', array('icon' => 'glyphicons home'))
	->addCrumb(__d('dna', 'Users'), '/' . $this->request->url);
?>
