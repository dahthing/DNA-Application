<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Blocks'), array(
		'plugin' => 'blocks', 'controller' => 'blocks', 'action' => 'index'))
	->addCrumb(__d('dna', 'Regions'), array(
		'plugin' => 'blocks', 'controller' => 'regions', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Region']['title'], array(
		'plugin' => 'blocks', 'controller' => 'regions', 'action' => 'edit',
		$this->params['pass'][0]
	));
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

?>
<?php echo $this->Form->create('Region');?>

<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Region'), '#region-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="region-main" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'label' => false,
					'class' => 'span10',
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
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
				$this->Form->button(__d('dna', 'Apply'), array('name' => 'apply', 'button' => 'default')) .
				$this->Form->button(__d('dna', 'Save'), array('button' => 'default')) .
				$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
				$this->Html->endBox();
			echo $this->Dna->adminBoxes();
		?>
	</div>

</div>
<?php echo $this->Form->end(); ?>
