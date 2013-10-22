<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Contacts'), array('plugin' => 'contacts', 'controller' => 'contacts', 'action' => 'index'))
	->addCrumb(__d('dna', 'Messages'), array('plugin' => 'contacts', 'controller' => 'messages', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Message']['id'] . ': ' . $this->data['Message']['title'], '/' . $this->request->url);
}

echo $this->Form->create('Message');

?>
<div class="row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Message'), '#message-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="message-main">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'label' => false,
					'class' => 'span10',
				));
				echo $this->Form->input('name', array(
					'label' => __d('dna', 'Name'),
				));
				echo $this->Form->input('email', array(
					'label' => __d('dna', 'Email'),
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('body', array(
					'label' => __d('dna', 'Body'),
				));
				echo $this->Form->input('phone', array(
					'label' => __d('dna', 'Phone'),
				));
				echo $this->Form->input('address', array(
					'label' => __d('dna', 'Address'),
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
				__d('dna', 'Cancel'),
				array('action' => 'index'),
				array('button' => 'danger')
			) .
			$this->Html->endBox();

		echo $this->Dna->adminBoxes();
	?>
	</div>
</div>
<?php echo $this->Form->end(); ?>