<?php
$this->extend('/Common/admin_edit');
$this->set('className', 'extensions-locales');
?>

<?php
$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('dna', 'Locales'), array('plugin' => 'extensions', 'controller' => 'extensions_locales', 'action' => 'index'))
	->addCrumb($this->params['pass'][0], '/' . $this->request->url);

echo $this->Form->create('Locale', array(
	'url' => array(
		'plugin' => 'extensions',
		'controller' => 'extensions_locales',
		'action' => 'edit',
		$locale
	),
));

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Content'), '#locale-content');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div class="locale-content" class="tab-pane">
			<?php
				echo $this->Form->input('Locale.content', array(
					'label' => __d('dna', 'Content'),
					'data-placement' => 'top',
					'value' => $content,
					'type' => 'textarea',
					'class' => 'span10',
				));
			?>
			</div>
			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>
	<div class="span4">
		<?php
			echo $this->Html->beginBox(__d('dna', 'Actions')) .
				$this->Form->button(__d('dna', 'Save'), array('button' => 'primary')) .
				$this->Html->link(__d('dna', 'Cancel'),
					array('action' => 'index'),
					array('button' => 'danger')
				) .
				$this->Html->endBox();
		?>
	</div>
</div>
<?php echo $this->Form->end(); ?>