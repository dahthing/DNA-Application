<?php
$this->Html->script(array('/taxonomy/js/vocabularies'), false);
$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html
		->addCrumb(__d('dna', 'Vocabularies'), array('plugin' => 'taxonomy', 'controller' => 'vocabularies', 'action' => 'index', $this->request->data['Vocabulary']['id'],))
		->addCrumb($this->request->data['Vocabulary']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html
		->addCrumb(__d('dna', 'Vocabularies'), array('plugin' => 'taxonomy', 'controller' => 'vocabularies', 'action' => 'index',))
		->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Vocabulary');

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Vocabulary'), '#vocabulary-basic');
			echo $this->Dna->adminTab(__d('dna', 'Options'), '#vocabulary-options');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="vocabulary-basic" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'class' => 'span10',
					'label' => false,
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('alias', array(
					'class' => 'alias span10',
					'label' => __d('dna', 'Alias'),
				));
				echo $this->Form->input('description', array(
					'label' => __d('dna', 'Description'),
				));
				echo $this->Form->input('Type.Type', array(
					'label' => __d('dna', 'Type'),
				));
			?>
			</div>

			<div id="vocabulary-options" class="tab-pane">
			<?php
				echo $this->Form->input('required', array(
					'label' => __d('dna', 'Required'),
					'class' => false,
				));
				echo $this->Form->input('multiple', array(
					'label' => __d('dna', 'Multiple'),
					'class' => false,
				));
				echo $this->Form->input('tags', array(
					'label' => __d('dna', 'Tags'),
					'class' => false,
				));
			?>
			</div>

			<?php echo $this->Dna->adminBoxes(); ?>
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
	?>
	</div>

</div>
<?php echo $this->Form->end(); ?>
