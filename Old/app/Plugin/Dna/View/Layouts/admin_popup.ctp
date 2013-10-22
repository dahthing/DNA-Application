<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?> - <?php echo __d('dna', 'Dna'); ?></title>
		<?php

		echo $this->Html->css(array(
			'/dna/css/dna-bootstrap',
			'/dna/css/dna-bootstrap-responsive',
		));
		echo $this->Layout->js();
		echo $this->Html->script(array(
			'/dna/js/html5',
			'/dna/js/jquery/jquery.min',
			'/dna/js/jquery/jquery.slug',
			'/dna/js/dna-bootstrap.js',
			'/dna/js/underscore-min',
			'/dna/js/admin',
		));

		echo $this->fetch('script');
		echo $this->fetch('css');

		?>
	</head>
	<body class="popup">
		<div class="container-fluid">
			<div class="row-fluid">
				<div id="content" class="span12">
					<?php echo $this->Layout->sessionFlash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
		<?php
		echo $this->Blocks->get('scriptBottom');
		echo $this->Js->writeBuffer();
		?>
	</body>
</html>
