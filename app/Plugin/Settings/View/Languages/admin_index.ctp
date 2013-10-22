<?php

$this->extend('/Common/admin_index');

$this->Html->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Settings'), array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix', 'Site'))
	->addCrumb(__d('dna', 'Languages'), '/' . $this->request->url);

?>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped">
			<?php
				$tableHeaders = $this->Html->tableHeaders(array(
					$this->Paginator->sort('id', __d('dna', 'Id')),
					$this->Paginator->sort('title', __d('dna', 'Title')),
					$this->Paginator->sort('native', __d('dna', 'Native')),
					$this->Paginator->sort('alias', __d('dna', 'Alias')),
					$this->Paginator->sort('status', __d('dna', 'Status')),
					__d('dna', 'Actions'),
				));
				?>
					<thead>
						<?php echo $tableHeaders; ?>
					</thead>
				<?php

				$rows = array();
				foreach ($languages as $language) {
					$actions = array();
					$actions[] = $this->Dna->adminRowActions($language['Language']['id']);
					$actions[] = $this->Dna->adminRowAction('',
						array('action' => 'moveup', $language['Language']['id']),
						array('icon' => 'chevron-up', 'tooltip' => __d('dna', 'Move up'))
					);
					$actions[] = $this->Dna->adminRowAction('',
						array('action' => 'movedown', $language['Language']['id']),
						array('icon' => 'chevron-down', 'tooltip' => __d('dna', 'Move down'))
					);
					$actions[] = $this->Dna->adminRowAction('',
						array('action' => 'edit', $language['Language']['id']),
						array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
					);
					$actions[] = $this->Dna->adminRowAction('',
						array('action' => 'delete', $language['Language']['id']),
						array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item')),
						__d('dna', 'Are you sure?')
					);

					$actions = $this->Html->div('item-actions', implode(' ', $actions));

					$rows[] = array(
						$language['Language']['id'],
						$language['Language']['title'],
						$language['Language']['native'],
						$language['Language']['alias'],
						$this->Html->status($language['Language']['status']),
						$actions,
					);
				}

				echo $this->Html->tableCells($rows);
			?>
			</table>
		</div>
	</div>
</div>
