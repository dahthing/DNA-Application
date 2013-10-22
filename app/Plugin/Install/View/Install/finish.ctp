<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>

	<p class="success">
	<?php echo __d('dna', '
		The user %s has been created with administrative rights.',
		sprintf('<strong>%s</strong>', $user['User']['username']));
	?>
	</p>

	<p>
		<?php echo __d('dna', 'Admin panel: %s', $this->Html->link(Router::url('/admin', true), Router::url('/admin', true))); ?>
	</p>

	<p>
	<?php
	echo __d('dna', 'You can start with %s or jump in and %s.',
		$this->Html->link(__d('dna', 'configuring your site'), $urlSettings),
		$this->Html->link(__d('dna', 'create a blog post'), $urlBlogAdd)
		);
	?>
	</p>

	<blockquote>
		<h3><?php echo __d('dna', 'Resources'); ?></h3>
		<ul class="bullet">
			<li><?php echo $this->Html->link('http://dna.org'); ?></li>
			<li><?php echo $this->Html->link('http://wiki.dna.org/'); ?></li>
			<li><?php echo $this->Html->link('http://github.com/dna/dna'); ?></li>
			<li><?php echo $this->Html->link('Dna Google Group', 'https://groups.google.com/forum/#!forum/dna'); ?></li>
		</ul>
	</blockquote>
	&nbsp;
</div>