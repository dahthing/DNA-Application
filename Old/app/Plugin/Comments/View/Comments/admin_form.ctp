<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('dna', 'Comments'), array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'index'))
	->addCrumb($this->request->data['Comment']['id'], '/' . $this->request->url);

echo $this->Form->create('Comment');

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Comment'), '#comment-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="comment-main" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'class' => 'span10',
				));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('body', array(
					'label' => __d('dna', 'Body'),
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
					array('action' => 'index'),
					array('button' => 'danger')
				) .
				$this->Form->input('status', array(
					'label' => __d('dna', 'Published'),
					'class' => false,
				)) .
				$this->Html->endBox();

			echo $this->Html->beginBox(__d('dna', 'Contact')) .
				$this->Form->input('name', array('label' => __d('dna', 'Name'), 'class' => 'span12')) .
				$this->Form->input('email', array('label' => __d('dna', 'Email'), 'class' => 'span12')) .
				$this->Form->input('website', array('label' => __d('dna', 'Website'), 'class' => 'span12')) .
				$this->Form->input('ip', array('disabled' => 'disabled', 'label' => __d('dna', 'Ip'))) .
				$this->Html->endBox();

			echo $this->Dna->adminBoxes();
		?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
