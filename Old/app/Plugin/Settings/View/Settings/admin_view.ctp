<div class="settings view">
<h2><?php echo __d('dna', 'Setting');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Key'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['key']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['value']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Input Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['input_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('dna', 'Params'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setting['Setting']['params']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__d('dna', 'Edit Setting'), array('action' => 'edit', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__d('dna', 'Delete Setting'), array('action' => 'delete', $setting['Setting']['id']), null, __d('dna', 'Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('dna', 'List Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('dna', 'New Setting'), array('action' => 'add')); ?> </li>
	</ul>
</div>
