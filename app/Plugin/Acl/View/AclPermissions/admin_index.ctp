<?php

$this->extend('/Common/admin_index');
$this->name = 'acl_permissions';
$this->Html->script('/acl/js/acl_permissions.js', false);

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'))
	->addCrumb(__d('dna', 'Permissions'), array(
		'plugin' => 'acl', 'controller' => 'acl_permissions',
	));

?>
<?php $this->start('actions'); ?>
<li class="btn-group">
<?php
	echo $this->Html->link(
		__d('dna', 'Tools') . ' ' . '<span class="caret"></span>',
		'#',
		array(
			'class' => 'btn dropdown-toggle',
			'data-toggle' => 'dropdown',
		)
	);

	$generateUrl = array(
		'plugin' => 'acl',
		'controller' => 'acl_actions',
		'action' => 'generate',
		'permissions' => 1
	);
	$out = $this->Dna->adminAction(__d('dna', 'Generate'),
		$generateUrl,
		array(
			'button' => false,
			'method' => 'post',
			'tooltip' => array(
				'data-title' => __d('dna', 'Create new actions (no removal)'),
				'data-placement' => 'right',
			),
		)
	);
	$out .= $this->Dna->adminAction(__d('dna', 'Synchronize'),
		$generateUrl + array('sync' => 1),
		array(
			'button' => false,
			'method' => 'post',
			'tooltip' => array(
				'data-title' => __d('dna', 'Create new & remove orphaned actions'),
				'data-placement' => 'right',
			),
		)
	);
	echo $this->Html->tag('ul', $out, array('class' => 'dropdown-menu'));
?>
</li>
<?php
	echo $this->Dna->adminAction(__d('dna', 'Edit Actions'),
		array('controller' => 'acl_actions', 'action' => 'index', 'permissions' => 1)
	);
?>
<?php $this->end(); ?>

<table class="table permission-table">
<?php
	$roleTitles = array_values($roles);
	$roleIds = array_keys($roles);

	$tableHeaders = array(
		__d('dna', 'Id'),
		__d('dna', 'Alias'),
	);
	$tableHeaders = array_merge($tableHeaders, $roleTitles);
	$tableHeaders = $this->Html->tableHeaders($tableHeaders);
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>
<?php

	$icon = '<i class="pull-right"></i>';
	$currentController = '';
	foreach ($acos as $index => $aco) {
		$id = $aco['Aco']['id'];
		$alias = $aco['Aco']['alias'];
		$class = '';
		if (substr($alias, 0, 1) == '_') {
			$level = 1;
			$class .= 'level-' . $level;
			$oddOptions = array('class' => 'hidden controller-' . $currentController);
			$evenOptions = array('class' => 'hidden controller-' . $currentController);
			$alias = substr_replace($alias, '', 0, 1);
		} else {
			$level = 0;
			$class .= ' controller';
			if ($aco['Aco']['children'] > 0) {
				$class .= ' perm-expand';
			}
			$oddOptions = array();
			$evenOptions = array();
			$currentController = $alias;
		}

		$row = array(
			$id,
			$this->Html->div(trim($class), $alias . $icon, array(
				'data-id' => $id,
				'data-alias' => $alias,
				'data-level' => $level,
			)),
		);

		foreach ($roles as $roleId => $roleTitle) {
			$row[] = '';
		}

		echo $this->Html->tableCells(array($row), $oddOptions, $evenOptions);
	}

?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>

</table>
