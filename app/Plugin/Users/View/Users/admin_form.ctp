<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('dna', 'Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['User']['name'], array(
		'plugin' => 'users', 'controller' => 'users', 'action' => 'edit',
		$this->data['User']['id']
	));
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), array('plugin' => 'users','controller' => 'users', 'action' => 'add'));
}
?>
<?php $this->start('actions'); ?>
<?php if ($this->request->params['action'] == 'admin_edit'): ?>
<?php
	echo $this->Dna->adminAction(__d('dna', 'Reset password'), array('action' => 'reset_password', $this->params['pass']['0']));
?>
<?php endif; ?>
<?php $this->end(); ?>

<?php echo $this->Form->create('User');?>

<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'User'), '#user-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="user-main" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('role_id', array('label' => __d('dna', 'Role')));
				$this->Form->inputDefaults(array(
					'class' => 'span10',
					'label' => false,
				));
				echo $this->Form->input('username', array(
					'label' => __d('dna', 'Username'),
				));
				echo $this->Form->input('name', array(
					'label' => __d('dna', 'Name'),
				));
				echo $this->Form->input('email', array(
					'label' => __d('dna', 'Email'),
				));
				echo $this->Form->input('website', array(
					'label' => __d('dna', 'Website'),
				));
			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Save'), array('button' => 'default')) .
			$this->Html->link(
			__d('dna', 'Cancel'), array('action' => 'index'),
			array('button' => 'danger')) .

			$this->Form->input('status', array(
				'label' => __d('dna', 'Status'),
				'class' => false,
			)) .

			$this->Html->endBox();

		echo $this->Dna->adminBoxes();
	?>
	</div>

</div>
<?php echo $this->Form->end(); ?>