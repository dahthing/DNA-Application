<?php
$this->extend('/Common/admin_edit');

$this->Html->script(array('/taxonomy/js/terms'), false);

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html
		->addCrumb(__d('dna', 'Vocabularies'), array('plugin' => 'taxonomy', 'controller' => 'vocabularies', 'action' => 'index'))
		->addCrumb($vocabulary['Vocabulary']['title'], array('plugin' => 'taxonomy', 'controller' => 'terms', 'action' => 'index', $vocabulary['Vocabulary']['id']))
		->addCrumb($this->request->data['Term']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html
		->addCrumb(__d('dna', 'Vocabularies'), array('plugin' => 'taxonomy', 'controller' => 'vocabularies', 'action' => 'index', $vocabulary['Vocabulary']['id'],))
		->addCrumb($vocabulary['Vocabulary']['title'], array('plugin' => 'taxonomy', 'controller' => 'terms', 'action' => 'index'))
		->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Term', array(
	'url' => '/' . $this->request->url,
));

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Term'), '#term-basic');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="term-basic" class="tab-pane">
			<?php
				echo $this->Form->input('Taxonomy.parent_id', array(
					'options' => $parentTree,
					'empty' => true,
					'label' => __d('dna', 'Parent'),
				));
				$this->Form->inputDefaults(array(
					'class' => 'span10',
					'label' => false,
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('slug', array(
					'label' => __d('dna', 'Slug'),
					'class' => 'slug span10',
				));
				echo $this->Form->input('description', array(
					'label' => __d('dna', 'Description'),
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
				array('action' => 'index', $vocabularyId),
				array('button' => 'danger')
			) .
			$this->Html->endBox();
		echo $this->Dna->adminBoxes();
	?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
