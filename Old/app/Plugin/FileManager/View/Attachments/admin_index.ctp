<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Attachments'), '/' . $this->request->url);

?>
<table class="table table-striped">
<?php

	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id', __d('dna', 'Id')),
		'&nbsp;',
		$this->Paginator->sort('title', __d('dna', 'Title')),
		__d('dna', 'URL'),
		__d('dna', 'Actions'),
	));

?>
	<thead>
	<?php echo $tableHeaders; ?>
	</thead>
<?php

	$rows = array();
	foreach ($attachments as $attachment) {
		$actions = array();
		$actions[] = $this->Dna->adminRowActions($attachment['Attachment']['id']);
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'attachments', 'action' => 'edit', $attachment['Attachment']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
		);
		$actions[] = $this->Dna->adminRowAction('',
			array('controller' => 'attachments', 'action' => 'delete', $attachment['Attachment']['id']),
			array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item')),
			__d('dna', 'Are you sure?'));

		$mimeType = explode('/', $attachment['Attachment']['mime_type']);
		$mimeType = $mimeType['0'];
		if ($mimeType == 'image') {
			$imgUrl = $this->Image->resize('/uploads/' . $attachment['Attachment']['slug'], 100, 200, true, array('class' => 'img-polaroid'));
			$thumbnail = $this->Html->link($imgUrl, $attachment['Attachment']['path'],
			array('escape' => false, 'class' => 'thickbox', 'title' => $attachment['Attachment']['title']));
		} else {
			$thumbnail = $this->Html->image('/dna/img/icons/page_white.png') . ' ' . $attachment['Attachment']['mime_type'] . ' (' . $this->Filemanager->filename2ext($attachment['Attachment']['slug']) . ')';
		}

		$actions = $this->Html->div('item-actions', implode(' ', $actions));

		$rows[] = array(
			$attachment['Attachment']['id'],
			$thumbnail,
			$attachment['Attachment']['title'],
			$this->Html->link(
				$this->Html->url($attachment['Attachment']['path'], true),
				$attachment['Attachment']['path'],
				array(
					'target' => '_blank',
				)
			),
			$actions,
		);
	}

	echo $this->Html->tableCells($rows);

?>
</table>
