<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Attachments'), array('plugin' => 'file_manager', 'controller' => 'attachments', 'action' => 'index'))
	->addCrumb($this->data['Attachment']['title'], '/' . $this->request->url);

echo $this->Form->create('Attachment', array('url' => array('controller' => 'attachments', 'action' => 'edit')));

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Attachment'), '#attachment-main');
		?>
		</ul>

		<div class="tab-content">

			<div id="attachment-main" class="tab-pane">
			<?php
				echo $this->Form->input('id');

				$fileType = explode('/', $this->data['Attachment']['mime_type']);
				$fileType = $fileType['0'];
				if ($fileType == 'image') {
					$imgUrl = $this->Image->resize('/uploads/' . $this->data['Attachment']['slug'], 200, 300, true, array('class' => 'img-polaroid'));
				} else {
					$imgUrl = $this->Html->image('/dna/img/icons/' . $this->Filemanager->mimeTypeToImage($this->data['Attachment']['mime_type'])) . ' ' . $this->data['Attachment']['mime_type'];
				}
				echo $this->Html->link($imgUrl, $this->data['Attachment']['path'], array(
					'class' => 'thickbox pull-right',
				));
				$this->Form->inputDefaults(array(
					'class' => 'span6',
					'label' => false,
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('excerpt', array(
					'label' => __d('dna', 'Caption'),
				));

				echo $this->Form->input('file_url', array(
					'label' => __d('dna', 'File URL'),
					'value' => Router::url($this->data['Attachment']['path'], true),
					'readonly' => 'readonly')
				);

				echo $this->Form->input('file_type', array(
					'label' => __d('dna', 'Mime Type'),
					'value' => $this->data['Attachment']['mime_type'],
					'readonly' => 'readonly')
				);

			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>

	<div class="span4">
	<?php
		$redirect = array('action' => 'index');
		if ($this->Session->check('Wysiwyg.redirect')) {
			$redirect = $this->Session->read('Wysiwyg.redirect');
		}
		echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Save')) .
			$this->Html->link(
				__d('dna', 'Cancel'),
				$redirect,
				array('class' => 'cancel', 'button' => 'danger')
			) .
			$this->Html->endBox();
	?>
	</div>
</div>
<?php echo $this->Form->end(); ?>