<?php

$this->extend('Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('dna', 'Locales'), '/' . $this->request->url);

?>
<?php echo $this->start('actions') ?>
<?php
	echo $this->Dna->adminAction(__d('dna', 'Upload'),
		array('action' => 'add')
	);
?>
<?php echo $this->end('actions') ?>

<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		'',
		__d('dna', 'Locale'),
		__d('dna', 'Default'),
		__d('dna', 'Actions'),
	));
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>

<?php
	$rows = array();
	foreach ($locales as $locale):
		$actions = array();

		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'activate', $locale),
			array('icon' => 'bolt', 'tooltip' => __d('dna', 'Activate'), 'method' => 'post')
		);
		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'edit', $locale),
			array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'delete', $locale),
			array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item')),
			__d('dna', 'Are you sure?')
		);

		$actions = $this->Html->div('item-actions', implode(' ', $actions));
		if ($locale == Configure::read('Site.locale')) {
			$status = $this->Html->status(1);
		} else {
			$status = $this->Html->status(0);
		}

		$rows[] = array(
			'',
			$locale,
			$status,
			$actions,
		);
	endforeach;

	echo $this->Html->tableCells($rows);
?>
</table>
