<?php
$this->extend('/Common/admin_index');
$this->name = 'extensions-plugins';

$this->Html
	->addCrumb('Admin', '/admin')
	->addCrumb(__d('dna', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('dna', 'Plugins'), '/' . $this->request->url);

?>
<?php $this->start('actions'); ?>
<?php
	echo $this->Dna->adminAction(
		__d('dna', 'Upload'),
		array('action' => 'add')
	);
?>
<?php $this->end(); ?>

<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		'',
		__d('dna', 'Alias'),
		__d('dna', 'Name'),
		__d('dna', 'Description'),
		__d('dna', 'Active'),
		__d('dna', 'Actions'),
	));
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>

<?php
	$rows = array();
	$plugins = Sanitize::clean($plugins);
	foreach ($plugins as $pluginAlias => $pluginData):
		if (in_array($pluginAlias, $corePlugins)) {
			continue;
		}

		$toggleText = $pluginData['active'] ? __d('dna', 'Deactivate') : __d('dna', 'Activate');
		$statusIcon = $this->Html->status($pluginData['active']);

		$actions = array();
		if (!in_array($pluginAlias, $bundledPlugins)):
			$icon = $pluginData['active'] ? 'off' : 'bolt';
			$actions[] = $this->Dna->adminRowAction('',
				array('action' => 'toggle',	$pluginAlias),
				array('icon' => $icon, 'tooltip' => $toggleText, 'method' => 'post')
			);
			$actions[] = $this->Dna->adminRowAction('',
				array('action' => 'delete', $pluginAlias),
				array('icon' => 'trash', 'tooltip' => __d('dna', 'Delete')),
				__d('dna', 'Are you sure?')
			);
		endif;

		if ($pluginData['active'] && !in_array($pluginAlias, $bundledPlugins)) {
			$actions[] = $this->Dna->adminRowAction('',
				array('action' => 'moveup', $pluginAlias),
				array('icon' => 'chevron-up', 'tooltip' => __d('dna', 'Move up'), 'method' => 'post'),
				__d('dna', 'Are you sure?')
			);

			$actions[] = $this->Dna->adminRowAction('',
				array('action' => 'movedown', $pluginAlias),
				array('icon' => 'chevron-down', 'tooltip' => __d('dna', 'Move down'), 'method' => 'post'),
				__d('dna', 'Are you sure?')
			);
		}

		if ($pluginData['needMigration']) {
			$actions[] = $this->Dna->adminRowAction(__d('dna', 'Migrate'), array(
				'action' => 'migrate',
				$pluginAlias,
			), array(), __d('dna', 'Are you sure?'));
		}

		$actions = $this->Html->div('item-actions', implode(' ', $actions));

		$rows[] = array(
			'',
			$pluginAlias,
			$pluginData['name'],
			$pluginData['description'],
			$statusIcon,
			$actions,
		);
	endforeach;

	echo $this->Html->tableCells($rows);
?>
</table>
