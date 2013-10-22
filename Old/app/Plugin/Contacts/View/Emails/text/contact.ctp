<?php
	$url = Router::url(array(
		'controller' => 'contacts',
		'action' => 'view',
		$contact['Contact']['alias'],
	), true);
	echo __d('dna', 'You have received a new message at: %s', $url) . "\n \n";
	echo __d('dna', 'Name: %s', $message['Message']['name']) . "\n";
	echo __d('dna', 'Email: %s', $message['Message']['email']) . "\n";
	echo __d('dna', 'Subject: %s', $message['Message']['title']) . "\n";
	echo __d('dna', 'IP Address: %s', $_SERVER['REMOTE_ADDR']) . "\n";
	echo __d('dna', 'Message: %s', $message['Message']['body']) . "\n";
?>