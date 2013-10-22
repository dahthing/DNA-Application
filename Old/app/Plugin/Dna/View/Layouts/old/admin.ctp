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
			'/dna/css/thickbox',
		));
		echo $this->Layout->js();
		echo $this->Html->script(array(
			'/dna/js/html5',
			'/dna/js/jquery/jquery.min',
			'/dna/js/jquery/jquery-ui.min',
			'/dna/js/jquery/jquery.slug',
			'/dna/js/jquery/jquery.cookie',
			'/dna/js/jquery/jquery.hoverIntent.minified',
			'/dna/js/jquery/superfish',
			'/dna/js/jquery/supersubs',
			'/dna/js/jquery/jquery.tipsy',
			'/dna/js/jquery/jquery.elastic-1.6.1.js',
			'/dna/js/jquery/thickbox-compressed',
			'/dna/js/underscore-min',
			'/dna/js/admin',
			'/dna/js/choose',
			'/dna/js/dna-bootstrap.js',
		));

		echo $this->fetch('script');
		echo $this->fetch('css');

		?>
	</head>
	<body>
		<div id="wrap">
			<?php echo $this->element('admin/header'); ?>
			<?php echo $this->element('admin/navigation'); ?>
			<div id="push"></div>
			<div id="content-container" class="container-fluid">
				<div class="row-fluid">
					<div id="content" class="clearfix">
						<?php echo $this->element('admin/breadcrumb'); ?>
						<div id="inner-content" class="span12">
							<?php echo $this->Layout->sessionFlash(); ?>
							<?php echo $this->fetch('content'); ?>
						</div>
					</div>
					&nbsp;
				</div>
			</div>
		</div>
		<?php echo $this->element('admin/footer'); ?>
		<?php
		echo $this->Blocks->get('scriptBottom');
		echo $this->Js->writeBuffer();
		?>
	</body>
</html>