<?php
$this->extend('/Common/admin_index');
$this->Html->script(array('Nodes.nodes'), false);

$this->Html
	->addCrumb('Admin', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), '/' . $this->request->url);

?>
<?php $this->start('actions'); ?>
<?php
	echo $this->Dna->adminAction(
		__d('dna', 'Create content'),
		array('action' => 'create'),
		array('button' => 'success')
	);
?>
<?php $this->end(); ?>
<?php

echo $this->element('admin/nodes_search');

echo $this->Form->create(
	'Node',
	array(
		'url' => array('controller' => 'nodes', 'action' => 'process'),
		'class' => 'form-inline'
	)
);

?>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped">
		<?php
			$tableHeaders = $this->Html->tableHeaders(array(
				'',
				$this->Paginator->sort('id', __d('dna', 'Id')),
				$this->Paginator->sort('title', __d('dna', 'Title')),
				$this->Paginator->sort('type', __d('dna', 'Type')),
				$this->Paginator->sort('user_id', __d('dna', 'User')),
				$this->Paginator->sort('status', __d('dna', 'Status')),
				''
			));
		?>
			<thead>
				<?php echo $tableHeaders; ?>
			</thead>

			<tbody>
			<?php foreach ($nodes as $node): ?>
				<tr>
					<td><?php echo $this->Form->checkbox('Node.' . $node['Node']['id'] . '.id'); ?></td>
					<td><?php echo $node['Node']['id']; ?></td>
					<td>
						<span>
						<?php
							echo $this->Html->link($node['Node']['title'], array(
								'admin' => false,
								'controller' => 'nodes',
								'action' => 'view',
								'type' => $node['Node']['type'],
								'slug' => $node['Node']['slug']
							));
						?>
						</span>
						<?php if ($node['Node']['promote']): ?>
						<span class="label label-info"><?php echo __d('dna', 'promoted'); ?></span>
						<?php endif ?>
					</td>
					<td>
						<?php echo $node['Node']['type']; ?>
					</td>
					<td>
						<?php echo $node['User']['username']; ?>
					</td>
					<td>
						<?php
							echo $this->element('admin/toggle', array(
								'id' => $node['Node']['id'],
								'status' => $node['Node']['status'],
							));
						?>
					</td>
					<td>
						<div class="item-actions">
						<?php
							echo $this->Dna->adminRowActions($node['Node']['id']);
							echo ' ' . $this->Dna->adminRowAction('',
								array('action' => 'edit', $node['Node']['id']),
								array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
							);
							echo ' ' . $this->Dna->adminRowAction('',
								'#Node' . $node['Node']['id'] . 'Id',
								array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item'), 'rowAction' => 'delete'),
								__d('dna', 'Are you sure?')
							);
						?>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>

		</table>

		<div class="row-fluid">
			<div id="bulk-action" class="control-group">
			<?php
				echo $this->Form->input('Node.action', array(
					'label' => __d('dna', 'Applying to selected'),
					'div' => 'input inline',
					'options' => array(
						'publish' => __d('dna', 'Publish'),
						'unpublish' => __d('dna', 'Unpublish'),
						'promote' => __d('dna', 'Promote'),
						'unpromote' => __d('dna', 'Unpromote'),
						'delete' => __d('dna', 'Delete'),
					),
					'empty' => true,
				));
			?>
				<div class="controls">
				<?php
					$jsVarName = uniqid('confirmMessage_');
					echo $this->Form->button(__d('dna', 'Submit'), array(
						'type' => 'button',
						'onclick' => sprintf('return Nodes.confirmProcess(app.%s)', $jsVarName),
					));
					$this->Js->set($jsVarName, __d('dna', '%s selected items?'));
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>
