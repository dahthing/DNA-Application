<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb(' Admin', '/admin')
	->addCrumb(__d('dna', 'Blocks'), array('plugin' => 'blocks', 'controller' => 'blocks', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Block']['title'], '/' . $this->request->url);
}
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Block');

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Block'), '#block-basic');
			echo $this->Dna->adminTab(__d('dna', 'Access'), '#block-access');
			echo $this->Dna->adminTab(__d('dna', 'Visibilities'), '#block-visibilities');
			echo $this->Dna->adminTab(__d('dna', 'Params'), '#block-params');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="block-basic" class="tab-pane">
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
					'rel' => __d('dna', 'unique name for your block'),
				));
				echo $this->Form->input('region_id', array(
					'label' => __d('dna', 'Region'),
					'rel' => __d('dna', 'if you are not sure, choose \'none\''),
				));
				echo $this->Form->input('body', array(
					'label' => __d('dna', 'Body'),
				));
				echo $this->Form->input('class', array(
					'label' => __d('dna', 'Class')
				));
				echo $this->Form->input('element', array(
					'label' => __d('dna', 'Element')
				));
			?>
			</div>

			<div id="block-access" class="tab-pane">
			<?php
				echo $this->Form->input('Role.Role', array(
					'class' => false,
				));
			?>
			</div>

			<div id="block-visibilities" class="tab-pane">
			<?php
				echo $this->Form->input('Block.visibility_paths', array(
					'label' => __d('dna', 'Visibility Paths'),
					'rel' => __d('dna', 'Enter one URL per line. Leave blank if you want this Block to appear in all pages.')
				));
			?>
			</div>

			<div id="block-params" class="tab-pane">
			<?php
				echo $this->Form->input('Block.params', array(
					'label' => __d('dna', 'Params'),
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
			$this->Form->input('status', array(
				'label' => __d('dna', 'Status'),
				'class' => false,
			)) .
			$this->Form->input('show_title', array(
				'label' => __d('dna', 'Show title ?'),
				'class' => false,
			)) .
			$this->Html->endBox();

		echo $this->Dna->adminBoxes();
		?>
	</div>

</div>
<?php echo $this->Form->end(); ?>
