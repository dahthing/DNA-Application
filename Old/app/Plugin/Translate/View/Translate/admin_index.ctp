<?php
$this->extend('/Common/admin_index');
$this->name = 'translate';

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Translate'), '/' . $this->request->url)
	->addCrumb($modelAlias)
	->addCrumb($record[$modelAlias]['title'], array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'edit', $record[$modelAlias]['id']));

?>
<?php $this->start('actions'); ?>
<?php
	echo $this->Dna->adminAction(
		__d('dna', 'Translate in a new language'),
		array(
			'plugin' => 'settings',
			'controller' => 'languages',
			'action' => 'select',
			$record[$modelAlias]['id'],
			$modelAlias
		),
		array(
			'button' => false,
		)
	);
?>
<?php $this->end(); ?>

<?php if (count($translations) > 0): ?>
	<table class="table table-striped">
	<?php
		$tableHeaders = $this->Html->tableHeaders(array(
			'',
			__d('dna', 'Title'),
			__d('dna', 'Locale'),
			__d('dna', 'Actions'),
		));
	?>
		<thead>
			<?php echo $tableHeaders; ?>
		</thead>
	<?php
		$rows = array();
		foreach ($translations as $translation):
			$actions = array();
			$actions[] = $this->Dna->adminRowAction('', array(
				'action' => 'edit',
				$id,
				$modelAlias,
				'locale' => $translation[$runtimeModelAlias]['locale'],
			), array(
				'icon' => 'pencil',
				'tooltip' => __d('dna', 'Edit this item'),
			));
			$actions[] = $this->Dna->adminRowAction('', array(
				'action' => 'delete',
				$id,
				$modelAlias,
				$translation[$runtimeModelAlias]['locale'],
			), array(
				'icon' => 'trash',
				'tooltip' => __d('dna', 'Remove this item'),
			) , __d('dna', 'Are you sure?'));

			$actions = $this->Html->div('item-actions', implode(' ', $actions));
			$rows[] = array(
				'',
				$translation[$runtimeModelAlias]['content'],
				$translation[$runtimeModelAlias]['locale'],
				$actions,
			);
		endforeach;

		echo $this->Html->tableCells($rows);
	?>
	</table>
<?php else: ?>
	<p><?php echo __d('dna', 'No translations available.'); ?></p>
<?php endif; ?>
