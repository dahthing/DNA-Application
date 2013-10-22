<?php echo __d('dna', 'Hello %s', $user['User']['name']); ?>,

<?php
	$url = Router::url(array(
		'controller' => 'users',
		'action' => 'activate',
		$user['User']['username'],
		$user['User']['activation_key'],
	), true);
	echo __d('dna', 'Please visit this link to activate your account: %s', $url);
?>