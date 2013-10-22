<?php
$url = isset($url) ? $url : array('action' => 'index');
?>
<div class="row-fluid">
	<div class="span12">
		<div class="clearfix filter">
			<?php
			echo $this->Form->create('Node', array(
				'class' => 'inline',
				'url' => $url,
			));

			$this->Form->inputDefaults(array(
				'label' => false,
				'class' => 'span11',
			));

			echo $this->Form->input('chooser', array(
				'type' => 'hidden',
				'value' => isset($this->request->query['chooser']),
			));

			echo $this->Form->input('filter', array(
				'title' => __d('dna', 'Search'),
				'placeholder' => __d('dna', 'Search...'),
				'div' => 'input text span3',
				'tooltip' => false,
			));

			echo $this->Form->input('type', array(
				'options' => $nodeTypes,
				'empty' => __d('dna', 'Type'),
				'div' => 'input select span2',
			));

			echo $this->Form->input('status', array(
				'options' => array(
					'1' => __d('dna', 'Published'),
					'0' => __d('dna', 'Unpublished'),
				),
				'empty' => __d('dna', 'Status'),
				'div' => 'input select span2',
			));

			echo $this->Form->input('promote', array(
				'options' => array(
					'1' => __d('dna', 'Yes'),
					'0' => __d('dna', 'No'),
				),
				'empty' => __d('dna', 'Promoted'),
				'div' => 'input select span2',
			));
			echo $this->Form->submit(__d('dna', 'Filter'), array('class' => 'btn',
				'div' => 'input submit span2'
			));
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>
