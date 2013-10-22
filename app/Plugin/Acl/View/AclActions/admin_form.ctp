<?php
$this->extend('/Common/admin_edit');
$this->set('className', 'acl_actions');
$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'))
	->addCrumb(__d('dna', 'Permissions'), array('plugin' => 'acl', 'controller' => 'acl_permissions'))
	->addCrumb(__d('dna', 'Actions'), array('plugin' => 'acl', 'controller' => 'acl_actions', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Aco']['id'] . ': ' . $this->data['Aco']['alias'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

?>
<h2 class="hidden-desktop"><?php echo $title_for_layout; ?></h2>
<?php echo $this->Form->create('Aco', array('url' => array('controller' => 'acl_actions', 'action' => 'add'))); ?>

<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Action'), '#action-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="action-main" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('parent_id', array(
					'options' => $acos,
					'empty' => true,
					'label' => __d('dna', 'Parent'),
					'rel' => __d('dna', 'Choose none if the Aco is a controller.'),
				));
				$this->Form->inputDefaults(array(
					'label' => false,
					'class' => 'span10',
				));
				echo $this->Form->input('alias', array(
					'label' => __d('dna', 'Alias'),
				));
			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Submit'), array('name' => 'apply', 'class' => 'btn')) .
			$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array('class' => 'cancel btn btn-danger')) .
			$this->Html->endBox();

		echo $this->Dna->adminBoxes();
	?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
