<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Settings'), array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix', 'Site'))
	->addCrumb(__d('dna', 'Language'), array('plugin' => 'settings', 'controller' => 'languages', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Language']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Language');

?>
<div class="row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Language'), '#language-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="language-main" class="tab-pane">
			<?php
				$this->Form->inputDefaults(array(
					'class' => 'span10',
				));
				echo $this->Form->input('id');
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('native', array(
					'label' => __d('dna', 'Native'),
				));
				echo $this->Form->input('alias', array(
					'label' => __d('dna', 'Alias'),
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
					array('class' => 'cancel', 'button' => 'danger')
				) .
				$this->Form->input('status', array('class' => false)) .
				$this->Html->endBox();

			echo $this->Dna->adminBoxes();
		?>
	</div>
</div>
<?php echo $this->Form->end(); ?>