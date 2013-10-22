<h2 class="hidden-desktop"><?php echo $title_for_layout; ?></h2>
<?php

$this->Html->addCrumb('Admin', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Content'), array('controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('dna', 'Create'), '/' . $this->request->url);

?>
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-content">
				<?php foreach ($types as $type): ?>
					<div class="type">
						<h3><?php echo $this->Html->link($type['Type']['title'], array('action' => 'add', $type['Type']['alias'])); ?></h3>
						<p><?php echo $type['Type']['description']; ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
