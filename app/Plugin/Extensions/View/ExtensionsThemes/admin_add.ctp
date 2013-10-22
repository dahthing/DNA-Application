<?php

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('dna', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('dna', 'Themes'), array('plugin' => 'extensions', 'controller' => 'extensions_themes', 'action' => 'index'))
	->addCrumb(__d('dna', 'Upload'), '/' . $this->request->url);

?>
<h2 class="hidden-desktop"><?php echo $title_for_layout; ?></h2>
<?php
echo $this->Form->create('Theme', array(
	'url' => array(
		'plugin' => 'extensions',
		'controller' => 'extensions_themes',
		'action' => 'add',
	),
	'type' => 'file',
));

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Upload'), '#themes-upload');
		?>
		</ul>

		<div class="tab-content">

			<div id="themes-upload" class="tab-pane">
			<?php
				echo $this->Form->input('Theme.file', array(
					'type' => 'file', 'button' => 'default',
				));
			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox('Publishing') .
			$this->Form->button(__d('dna', 'Upload'), array('button' => 'default')) .
			$this->Form->end() .
			$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
			$this->Html->endBox();
		echo $this->Dna->adminBoxes();
	?>
	</div>

</div>
<?php echo $this->Form->end(); ?>
