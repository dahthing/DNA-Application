<?php
echo $this->Form->input('comment_status', array(
	'type' => 'radio',
	'class' => false,
	'options' => array(
		'0' => __d('dna', 'Disabled'),
		'1' => __d('dna', 'Read only'),
		'2' => __d('dna', 'Read/Write'),
	),
	'default' => $type['Type']['comment_status'],
	'legend' => false,
	'label' => true
));
?>
