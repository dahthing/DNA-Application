<?php

$this->extend('/Common/admin_edit');
$this->Html->script(array('Nodes.nodes'), false);

$this->Html
	->addCrumb('Admin', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_add') {
	$formUrl = array('action' => 'add', $typeAlias);
	$this->Html
		->addCrumb(__d('dna', 'Create'), array('controller' => 'nodes', 'action' => 'create'))
		->addCrumb($type['Type']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_edit') {
	$formUrl = array('action' => 'edit');
	$this->Html->addCrumb($this->request->data['Node']['title'], '/' . $this->request->url);
}

echo $this->Form->create('Node', array('url' => $formUrl));

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', $type['Type']['title']), '#node-main');
			echo $this->Dna->adminTab(__d('dna', 'Access'), '#node-access');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="node-main" class="tab-pane">
			<?php
				echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $nodes, 'empty' => true));
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'class' => 'span10',
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('slug', array(
					'class' => 'span10 slug',
					'label' => __d('dna', 'Slug'),
				));
				echo $this->Form->input('excerpt', array(
					'label' => __d('dna', 'Excerpt'),
				));
				echo $this->Form->input('body', array(
					'label' => __d('dna', 'Body'),
				));
			?>
			</div>

			<div id="node-access" class="tab-pane">
			<?php
				echo $this->Form->input('Role.Role', array('class' => false));
			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>

	</div>
	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Apply'), array('name' => 'apply', 'class' => 'btn')) .
			$this->Form->button(__d('dna', 'Save'), array('class' => 'btn btn-primary')) .
			$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array('class' => 'cancel btn btn-danger')) .
			$this->Form->input('status', array(
				'label' => __d('dna', 'Published'),
				'class' => false,
			)) .
			$this->Form->input('promote', array(
				'label' => __d('dna', 'Promoted to front page'),
				'class' => false,
			)) .
			$this->Form->input('user_id', array(
				'label' => __d('dna', 'Publish as '),
			)) .
			$this->Form->input('created', array(
				'type' => 'text',
				'class' => 'span10',
			));

		echo $this->Html->endBox();

		echo $this->Dna->adminBoxes();
	?>
	</div>
</div>
<?php echo $this->Form->end(); ?>