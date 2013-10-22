<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('dna', 'Contacts'), array('controller' => 'contacts', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Contact']['title']);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('dna', 'Add'), '/' . $this->request->url);
}

echo $this->Form->create('Contact');

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Dna->adminTab(__d('dna', 'Contact'), '#contact-basic');
			echo $this->Dna->adminTab(__d('dna', 'Details'), '#contact-details');
			echo $this->Dna->adminTab(__d('dna', 'Message'), '#contact-message');
			echo $this->Dna->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="contact-basic" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array('class' => 'span10'));
				echo $this->Form->input('title', array(
					'label' => __d('dna', 'Title'),
				));
				echo $this->Form->input('alias', array(
					'label' => __d('dna', 'Alias'),
				));
				echo $this->Form->input('email', array(
					'label' => __d('dna', 'Email')
				));
				echo $this->Form->input('body', array(
					'label' => __d('dna', 'Body'),
				));
			?>
			</div>

			<div id="contact-details" class="tab-pane">
			<?php
				echo $this->Form->input('name', array(
					'label' => __d('dna', 'Name'),
				));
				echo $this->Form->input('position', array(
					'label' => __d('dna', 'Position'),
				));
				echo $this->Form->input('address', array(
					'label' => __d('dna', 'Address'),
				));
				echo $this->Form->input('address2', array(
					'label' => __d('dna', 'Address2'),
				));
				echo $this->Form->input('state', array(
					'label' => __d('dna', 'State'),
				));
				echo $this->Form->input('country', array(
					'label' => __d('dna', 'Country'),
				));
				echo $this->Form->input('postcode', array(
					'label' => __d('dna', 'Post Code'),
				));
				echo $this->Form->input('phone', array(
					'label' => __d('dna', 'Phone'),
				));
				echo $this->Form->input('fax', array(
					'label' => __d('dna', 'Fax'),
				));
			?>
			</div>

			<div id="contact-message" class="tab-pane">
			<?php
				echo $this->Form->input('message_status', array(
					'label' => __d('dna', 'Let users leave a message'),
					'class' => false,
				));
				echo $this->Form->input('message_archive', array(
					'label' => __d('dna', 'Save messages in database'),
					'class' => false,
				));
				echo $this->Form->input('message_notify', array(
					'label' => __d('dna', 'Notify by email instantly'),
					'class' => false,
				));
				echo $this->Form->input('message_spam_protection', array(
					'label' => __d('dna', 'Spam protection (requires Akismet API key)'),
					'class' => false,
				));
				echo $this->Form->input('message_captcha', array(
					'label' => __d('dna', 'Use captcha? (requires Recaptcha API key)'),
					'class' => false,
				));

				echo $this->Html->link(__d('dna', 'You can manage your API keys here.'), array(
					'plugin' => 'settings',
					'controller' => 'settings',
					'action' => 'prefix',
					'Service',
				));

				echo $this->Dna->adminTabs();
			?>
			</div>
		</div>
	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('dna', 'Publishing')) .
			$this->Form->button(__d('dna', 'Apply'), array('name' => 'apply')) .
			$this->Form->button(__d('dna', 'Save')) .
			$this->Html->link(
			__d('dna', 'Cancel'),
			array('action' => 'index'),
			array('button' => 'danger')
		) .
			$this->Form->input('status', array('label' => __d('dna', 'Published'), 'class' => false)) .
		$this->Html->endBox();

		echo $this->Dna->adminBoxes();
	?>
	</div>
</div>

<?php echo $this->Form->end(); ?>
