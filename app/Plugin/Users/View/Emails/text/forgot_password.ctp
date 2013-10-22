<?php echo __d('dna', 'Hello %s', $user['User']['name']); ?>,

<?php
	$url = Router::url(array(
		'controller' => 'users',
		'action' => 'reset',
		$user['User']['username'],
		$activationKey,
	), true);
	echo __d('dna', 'Please visit this link to reset your password: %s', $url);
?>


<?php echo __d('dna', 'If you did not request a password reset, then please ignore this email.'); ?>


<?php echo __d('dna', 'IP Address: %s', $_SERVER['REMOTE_ADDR']); ?>
