<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Menus'), array('plugin' => 'menus', 'controller' => 'menus', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Menu']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Menu');

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Menu'), '#menu-basic');
			echo $this->Dna->adminTab(__d('dna', 'Misc.'), '#menu-misc');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="menu-basic" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'class' => 'span10',
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('alias', array(
					'label' => __d('dna', 'Alias'),
				));
				echo $this->Form->input('description', array(
					'label' => __d('dna', 'Description'),
				));
			?>
			</div>

			<div id="menu-misc" class="tab-pane">
			<?php
				echo $this->Form->input('params', array(
					'label' => __d('dna', 'Params'),
				));
			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>

	<div class="span4">
		<?php
		echo $this->Html->beginBox('Publishing') .
			$this->Form->button(__d('dna', 'Apply'), array('name' => 'apply', 'button' => 'default')) .
			$this->Form->button(__d('dna', 'Save'), array('button' => 'default')) .
			$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
			$this->Html->endBox();

		$this->Dna->adminBoxes();
		?>
	</div>

</div>
<?php echo $this->Form->end(); ?>
