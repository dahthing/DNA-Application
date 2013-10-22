<?php
$this->extend('/Common/admin_edit');
$this->set('className', 'translate');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Translate'), '/' . $this->request->url)
	->addCrumb($modelAlias)
	->addCrumb($this->data[$modelAlias]['title']);

echo $this->Form->create($modelAlias, array('url' => array(
	'plugin' => 'translate',
	'controller' => 'translate',
	'action' => 'edit',
	$id,
	$modelAlias,
	'locale' => $this->params['named']['locale'],
)));
?>
<div class="row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Translate'), '#translate-main');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="translate-main" class="tab-pane">
			<?php
				$this->Form->inputDefaults(array(
					'class' => 'span10',
				));
				foreach ($fields as $field):
					echo $this->Form->input($modelAlias . '.' . $field);
				endforeach;
			?>
			</div>

			<?php echo $this->Dna->adminTabs(); ?>
		</div>
	</div>
	<div class="span4">
		<?php echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Save'), array('class' => 'btn')) .
			$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index', $this->request->params['pass'][0], $this->request->params['pass'][1]), array('class' => 'cancel btn btn-danger')) .
			$this->Html->endBox(); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
