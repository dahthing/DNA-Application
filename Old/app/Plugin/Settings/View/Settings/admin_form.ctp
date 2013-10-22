<?php
$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('dna', 'Settings'), array(
		'admin' => true,
		'plugin' => 'settings',
		'controller' => 'settings',
		'action' => 'index',
	));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Setting']['key'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Setting');

?>
<div class="row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Settings'), '#setting-basic');
			echo $this->Dna->adminTab(__d('dna', 'Misc'), '#setting-misc');
		?>
		</ul>

		<div class="tab-content">
			<div id="setting-basic" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'label' => false,
					'class' => 'span10',
				));
				echo $this->Form->input('key', array(
					'rel' => __d('dna', "e.g., 'Site.title'"),
					'label' => __d('dna', 'Key'),
				));
				echo $this->Form->input('value', array(
					'label' => __d('dna', 'Value'),
				));
			?>
			</div>

			<div id="setting-misc" class="tab-pane">
			<?php
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('description', array(
					'label' => __d('dna', 'Description'),
				));
				echo $this->Form->input('input_type', array(
					'label' => __d('dna', 'Input Type'),
					'rel' => __d('dna', "e.g., 'text' or 'textarea'"),
				));
				echo $this->Form->input('editable', array(
					'label' => __d('dna', 'Editable'),
					'class' => false,
				));
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
		echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Save'), array('button' => 'default')) .
			$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array(
				'button' => 'danger')) .
			$this->Html->endBox();

		echo $this->Dna->adminBoxes();
	?>
	</div>

</div>
<?php echo $this->Form->end(); ?>