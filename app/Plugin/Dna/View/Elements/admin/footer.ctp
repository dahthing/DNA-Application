<footer class="navbar-inverse">
	<div class="navbar-inner">

	<div class="footer-content">
	<?php
		$link = $this->Html->link(
			__d('dna', 'Dna %s', strval(Configure::read('Dna.version'))),
			'http://www.nomeatus.com'
		);
	?>
	</div>

	</div>
</footer>