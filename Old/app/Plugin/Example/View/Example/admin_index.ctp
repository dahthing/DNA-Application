<?php
$this->extend('/Common/admin_index');
$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb('Example', array('controller' => 'example', 'action' => 'index'));
?>
<?php $this->start('actions'); ?>
<?php
	echo $this->Dna->adminAction(
		'New Tab',
		array('action' => 'add')
	);
	echo $this->Dna->adminAction(
		'Chooser Example',
		array('action' => 'chooser')
	);
?>
<?php $this->end(); ?>

<p><?php echo 'content here'; ?></p>