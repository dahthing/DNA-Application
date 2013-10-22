<?php
$crumbs = $this->Html->getCrumbs(
	$this->Html->tag('li', '', array(
		'class' => 'divider',
	))
);
?>
<?php if ($crumbs): ?>
<ul class="breadcrumb">
    <li><?php echo __d('dna','You are here: ');?></li>
    <?php echo $crumbs; ?>
</ul>

<?php endif; ?>
