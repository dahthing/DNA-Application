<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Blocks'), array('action' => 'index'));

echo $this->Form->create('Block',
	array('url' => array('controller' => 'blocks', 'action' => 'process')),
	array('class' => 'form-inline')
);

$chooser = isset($this->request->query['chooser']);

?>
<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		'',
		$this->Paginator->sort('id', __d('dna', 'Id')),
		$this->Paginator->sort('title', __d('dna', 'Title')),
		$this->Paginator->sort('alias', __d('dna', 'Alias')),
		$this->Paginator->sort('region_id', __d('dna', 'Region')),
		$this->Paginator->sort('status', __d('dna', 'Status')),
		__d('dna', 'Actions'),
	));
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>
<?php
	$rows = array();
	foreach ($blocks as $block) {
		$actions = array();
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'blocks', 'action' => 'moveup', $block['Block']['id']),
			array('icon' => 'arrow-up', 'tooltip' => __d('dna', 'Move up'),
		));
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'blocks', 'action' => 'movedown', $block['Block']['id']),
			array('icon' => 'arrow-down', 'tooltip' => __d('dna', 'Move down'),
			)
		);
		$actions[] = $this->Dna->adminRowActions($block['Block']['id']);
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'blocks', 'action' => 'edit', $block['Block']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			'#Block' . $block['Block']['id'] . 'Id',
			array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item'), 'rowAction' => 'delete'),
			__d('dna', 'Are you sure?')
		);

		if ($chooser) {
			$checkbox = null;
			$actions = array(
				$this->Dna->adminRowAction(__d('dna', 'Choose'), '#', array(
					'class' => 'item-choose',
					'data-chooser_type' => 'Block',
					'data-chooser_id' => $block['Block']['id'],
					'data-chooser_title' => $block['Block']['title'],
				)),
			);
		} else {
			$checkbox = $this->Form->checkbox('Block.' . $block['Block']['id'] . '.id');
		}

		$actions = $this->Html->div('item-actions', implode(' ', $actions));

		$rows[] = array(
			$checkbox,
			$block['Block']['id'],
			$this->Html->link($block['Block']['title'], array('controller' => 'blocks', 'action' => 'edit', $block['Block']['id'])),
			$block['Block']['alias'],
			$block['Region']['title'],
			$this->element('admin/toggle', array(
				'id' => $block['Block']['id'],
				'status' => $block['Block']['status'],
			)),
			$actions,
		);
	}

	echo $this->Html->tableCells($rows);
?>
</table>

<?php if (!$chooser): ?>
<div class="row-fluid">
	<div id="bulk-action" class="control-group">
		<?php
			echo $this->Form->input('Block.action', array(
				'label' => false,
				'div' => 'input inline',
				'options' => array(
					'publish' => __d('dna', 'Publish'),
					'unpublish' => __d('dna', 'Unpublish'),
					'delete' => __d('dna', 'Delete'),
				),
				'empty' => true,
			));
		?>
		<div class="controls">
			<?php echo $this->Form->end(__d('dna', 'Submit')); ?>
		</div>
	</div>
</div>
<?php endif; ?>
