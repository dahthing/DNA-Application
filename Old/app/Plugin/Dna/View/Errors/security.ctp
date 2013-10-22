<?php $title_for_layout = __d('dna', 'Page not found'); ?>
<h2><?php echo __d('dna', 'Security Error'); ?></h2>
<p class="error">
	<?php echo __d('dna', 'The requested address was not found on this server.'); ?>
</p>
<?php if (Configure::read('debug') > 0): ?>
<p class="notice">
	<?php echo __d('dna', 'Request blackholed due to "%s" violation.', $type); ?>
</p>
<?php endif; ?>
<?php Configure::write('debug', 0); ?>