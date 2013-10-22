<h2 class="hidden-desktop"><?php echo $title_for_layout; ?></h2>
<?php
$this->Html
	->addCrumb('Admin', '/admin')
	->addCrumb(__d('dna', 'Dashboard'), '/' . $this->request->url);
?>