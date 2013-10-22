<nav class="navbar-inverse sidebar">
	<div class="navbar-inner">
	<?php
		echo $this->Dna->adminMenus(DnaNav::items(), array(
			'htmlAttributes' => array(
				'id' => 'sidebar-menu',
			),
		));
	?>
	</div>
</nav>