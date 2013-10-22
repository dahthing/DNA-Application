<?php
	echo __d('dna', 'A new comment has been posted under: %s', $node['Node']['title']) . "\n \n";

	echo Router::url($node['Node']['url'], true) . '#comment-' . $commentId . "\n \n";

	echo __d('dna', 'Name: %s', $data['name']) . "\n";
	echo __d('dna', 'Email: %s', $data['email']) . "\n";
	echo sprintf( __d('dna', 'Website: %s'), $data['website']) . "\n";
	echo __d('dna', 'IP Address: %s', $data['ip']) . "\n";
	echo __d('dna', 'Comment: %s', $data['body']) . "\n";
?>