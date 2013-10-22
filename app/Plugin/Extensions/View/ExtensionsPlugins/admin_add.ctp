<?php
$this->Html
	->addCrumb( ' Admin', '/admin')
	->addCrumb(__d('dna', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('dna', 'Plugins'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('dna', 'Upload'), '/' . $this->request->url);

echo $this->Form->create('Plugin', array(
	'url' => array(
		'plugin' => 'extensions',
		'controller' => 'extensions_plugins',
		'action' => 'add',
	),
	'type' => 'file',
));

?>
<h2 class="hidden-desktop"><?php echo $title_for_layout; ?></h2>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Upload'), '#plugin-upload');
		?>
		</ul>

		<div class="tab-content">
			<div id="plugin-upload" class="tab-pane">
			<?php
				echo $this->Form->input('Plugin.file', array(
					'type' => 'file',
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
