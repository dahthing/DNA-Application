<?php
if (isset($this->request->query['urls'])) {
	foreach ($permissions as $acoId => &$aco) {
		$aco[key($aco)]['url'] = array(
			'up' => $this->Html->link('',
				array('controller' => 'acl_actions', 'action' => 'moveup', $acoId, 'up'),
				array('icon' => 'chevron-up', 'tooltip' => __d('dna', 'Move up'))
			),
			'down' => $this->Html->link('',
				array('controller' => 'acl_actions','action' => 'movedown', $acoId, 'down'),
				array('icon' => 'chevron-down', 'tooltip' => __d('dna', 'Move down'))
			),
			'edit' => $this->Html->link('',
				array('controller' => 'acl_actions', 'action' => 'edit', $acoId),
				array('icon' => 'pencil', 'tooltip' => __d('dna', 'Edit this item'))
			),
			'del' => $this->Form->postLink('',
				array('controller' => 'acl_actions', 'action' => 'delete', $acoId),
				array('icon' => 'trash', 'tooltip' => __d('dna', 'Remove this item')),
				__d('dna', 'Are you sure?')
			),
		);
	}
}
echo json_encode(compact('aros', 'permissions', 'level'));
