<?php

$header =<<<EOF
<?php
\$this->viewVars['title_for_layout'] = __d('dna', '$pluralHumanName');
\$this->extend('/Common/admin_edit');

\$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', '${pluralHumanName}'), array('action' => 'index'));

if (\$this->action == 'admin_edit') {
	\$this->Html->addCrumb(\$this->data['$modelClass']['$displayField'], '/' . \$this->request->url);
	\$this->viewVars['title_for_layout'] = '$pluralHumanName: ' . \$this->data['$modelClass']['$displayField'];
} else {
	\$this->Html->addCrumb(__d('dna', 'Add'), '/' . \$this->request->url);
}

echo \$this->Form->create('{$modelClass}');

?>\n
EOF;
echo $header;

$primaryTab = strtolower(Inflector::slug($singularHumanName, '-'));

?>
<div class="<?php echo $pluralVar; ?> row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php echo "<?php\n"; ?>
		<?php echo "\techo \$this->Dna->adminTab(__d('dna', '$singularHumanName'), '#$primaryTab');\n"; ?>
		<?php echo "\techo \$this->Dna->adminTabs();\n"; ?>
		<?php echo "?>\n"; ?>
		</ul>

		<div class="tab-content">
			<div id='<?php echo $primaryTab; ?>' class="tab-pane">
<?php
				echo "\t\t\t<?php\n";
				echo "\t\t\t\techo \$this->Form->input('{$primaryKey}');\n";
				echo "\t\t\t\t\$this->Form->inputDefaults(array('label' => false, 'class' => 'span10'));\n";
				foreach ($fields as $field) {
					if ($field == $primaryKey) {
						continue;
					} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
						$fieldLabel = Inflector::humanize($field);
						echo <<<EOF
				echo \$this->Form->input('{$field}', array(
					'label' => '$fieldLabel',
				));\n
EOF;
					}
				}
				if (!empty($associations['hasAndBelongsToMany'])) {
					foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
						echo "\t\t\t\techo \$this->Form->input('{$assocName}');\n";
					}
				}
				echo "\t\t\t\techo \$this->Dna->adminTabs();\n";
				echo "\t\t\t?>\n";
?>
			</div>
		</div>

	</div>

	<div class="span4">
	<?php
		echo <<<EOF
<?php
		echo \$this->Html->beginBox(__d('dna', 'Publishing')) .
			\$this->Form->button(__d('dna', 'Apply'), array('name' => 'apply')) .
			\$this->Form->button(__d('dna', 'Save'), array('class' => 'btn btn-primary')) .
			\$this->Html->link(__d('dna', 'Cancel'), array('action' => 'index'), array('class' => 'btn btn-danger')) .
			\$this->Html->endBox();
		?>\n
EOF;
	?>
	</div>

</div>
<?php echo "<?php echo \$this->Form->end(); ?>\n"; ?>
