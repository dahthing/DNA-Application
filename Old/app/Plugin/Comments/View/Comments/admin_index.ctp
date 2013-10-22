<?php

if (!$this->request->is('ajax') && isset($this->request->params['admin'])):
	$this->Html->script('Comments.admin', array('inline' => false));
endif;

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('dna', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('dna', 'Comments'), array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'index'));

if (isset($criteria['Comment.status'])) {
	if ($criteria['Comment.status'] == '1') {
		$this->Html->addCrumb(__d('dna', 'Published'), '/' . $this->request->url);
		$this->viewVars['title_for_layout'] = __d('dna', 'Comments: Published');
	} else {
		$this->Html->addCrumb(__d('dna', 'Approval'), '/' . $this->request->url);
		$this->viewVars['title_for_layout'] = __d('dna', 'Comments: Approval');
	}
}

echo $this->element('admin/modal', array(
	'id' => 'comment-modal',
	'class' => 'hide',
));

?>
<?php $this->start('actions'); ?>
<?php
	echo $this->Dna->adminAction(
		__d('dna', 'Published'),
		array('action' => 'index', '?' => array('status' => '1'))
	);
	echo $this->Dna->adminAction(
		__d('dna', 'Approval'),
		array('action' => 'index', '?' => array('status' => '0'))
	);
?>
<?php $this->end(); ?>

<?php echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'process'))); ?>
<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		'',
		$this->Paginator->sort('id', __d('dna', 'Id')),
		$this->Paginator->sort('name', __d('dna', 'Name')),
		$this->Paginator->sort('email', __d('dna', 'Email')),
		$this->Paginator->sort('node_id', __d('dna', 'Node')),
		'',
		$this->Paginator->sort('created', __d('dna', 'Created')),
		__d('dna', 'Actions'),
	));
?>
	<thead>
	<?php echo $tableHeaders; ?>
	</thead>
<?php

	$rows = array();
	foreach ($comments as $comment) {
		$actions = array();
		$actions[] = $this->Dna->adminRowActions($comment['Comment']['id']);
		$actions[] = $this->Dna->adminRowAction('',
			array('action' => 'edit', $comment['Comment']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			'#Comment' . $comment['Comment']['id'] . 'Id',
			array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item'), 'rowAction' => 'delete'),
			__d('dna', 'Are you sure?')
		);

		$actions = $this->Html->div('item-actions', implode(' ', $actions));

		$title = empty($comment['Comment']['title']) ? 'Comment' : $comment['Comment']['title'];
		$rows[] = array(
			$this->Form->checkbox('Comment.' . $comment['Comment']['id'] . '.id'),
			$comment['Comment']['id'],
			$comment['Comment']['name'],
			$comment['Comment']['email'],
			$this->Html->link($comment['Node']['title'], array(
				'admin' => false,
				'plugin' => 'nodes',
				'controller' => 'nodes',
				'action' => 'view',
				'type' => $comment['Node']['type'],
				'slug' => $comment['Node']['slug'],
			)),
			$this->Html->link($this->Html->image('/dna/img/icons/comment.png'), '#',
				array(
					'class' => 'comment-view',
					'data-title' => $title,
					'data-content' => $comment['Comment']['body'],
					'escape' => false
				)),
			$comment['Comment']['created'],
			$actions,
		);
	}

	echo $this->Html->tableCells($rows);
?>

</table>
<div class="row-fluid">
	<div id="bulk-action" class="control-group">
		<?php
			echo $this->Form->input('Comment.action', array(
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
