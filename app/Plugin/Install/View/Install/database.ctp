<?php
echo $this->Form->create(false, array(
	'url' => array(
		'plugin' => 'install',
		'controller' => 'install',
		'action' => 'database'
	),
), array(
	'class' => 'inline',
));
?>
<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php
		$this->Form->inputDefaults(array(
			'label' => false,
			'class' => 'span10',
		));
		echo $this->Form->input('datasource', array(
			'placeholder' => __d('dna', 'Database'),
			'default' => 'Database/Mysql',
			'empty' => false,
			'class' => false,
			'options' => array(
				'Database/Mysql' => 'mysql',
				'Database/Sqlite' => 'sqlite',
				'Database/Postgres' => 'postgres',
				'Database/Sqlserver' => 'mssql',
			),
		));
		echo $this->Form->input('host', array(
			'placeholder' => __d('dna', 'Host'),
			'default' => 'localhost',
			'tooltip' => __d('dna', 'Database hostname or IP Address'),
			'before' => '<span class="add-on"><i class="icon-home"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('login', array(
			'placeholder' => __d('dna', 'Login'),
			'default' => 'root',
			'tooltip' => __d('dna', 'Database login/username'),
			'before' => '<span class="add-on"><i class="icon-user"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('password', array(
			'placeholder' => __d('dna', 'Password'),
			'tooltip' => __d('dna', 'Database password'),
			'before' => '<span class="add-on"><i class="icon-key"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('database', array(
			'placeholder' => __d('dna', 'Name'),
			'default' => 'dna',
			'tooltip' => __d('dna', 'Database name'),
			'before' => '<span class="add-on"><i class="icon-briefcase"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('prefix', array(
			'placeholder' => __d('dna', 'Prefix'),
			'tooltip' => __d('dna', 'Table prefix (leave blank if unknown)'),
			'before' => '<span class="add-on"><i class="icon-minus"></i></span>',
			'div' => 'input input-prepend',
		));
		echo $this->Form->input('port', array(
			'placeholder' => __d('dna', 'Port'),
			'tooltip' => __d('dna', 'Database port (leave blank if unknown)'),
			'before' => '<span class="add-on"><i class="icon-asterisk"></i></span>',
			'div' => 'input input-prepend',
		));
	?>
</div>
<div class="form-actions">
	<?php echo $this->Form->submit('Submit', array('button' => 'success', 'div' => 'input submit')); ?>
</div>
<?php echo $this->Form->end(); ?>