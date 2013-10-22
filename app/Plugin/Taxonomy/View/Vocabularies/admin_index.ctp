<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('dna', 'Vocabularies'), '/' . $this->request->url);

?>
<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id', __d('dna', 'Id')),
		$this->Paginator->sort('title', __d('dna', 'Title')),
		$this->Paginator->sort('alias', __d('dna', 'Alias')),
		__d('dna', 'Actions'),
	));
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>
<?php

	$rows = array();
	foreach ($vocabularies as $vocabulary) :
		$actions = array();
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'terms', 'action' => 'index', $vocabulary['Vocabulary']['id']),
			array('icon' => 'zoom-in', 'tooltip' => __d('dna', 'View terms'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'moveup', $vocabulary['Vocabulary']['id']),
			array('icon' => 'chevron-up', 'tooltip' => __d('dna', 'Move up'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'movedown', $vocabulary['Vocabulary']['id']),
			array('icon' => 'chevron-down', 'tooltip' => __d('dna', 'Move down'))
		);
		$actions[] = $this->Dna->adminRowActions($vocabulary['Vocabulary']['id']);
		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'edit', $vocabulary['Vocabulary']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'vocabularies', 'action' => 'delete', $vocabulary['Vocabulary']['id']),
			array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item')),
			__d('dna', 'Are you sure?'));
		$actions = $this->Html->div('item-actions', implode(' ', $actions));
		$rows[] = array(
			$vocabulary['Vocabulary']['id'],
			$this->Html->link($vocabulary['Vocabulary']['title'], array('controller' => 'terms', 'action' => 'index', $vocabulary['Vocabulary']['id'])),
			$vocabulary['Vocabulary']['alias'],
			$actions,
		);
	endforeach;

	echo $this->Html->tableCells($rows);
?>
</table>
